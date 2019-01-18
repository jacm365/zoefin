<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as Auth;
use Location\Coordinate;
use Location\Distance\Vincenty;

class AgentContactsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Gets the users geographic data.
     *
     * @return array
     */
    private function getZipGeo($zip)
    {
        $googleAPIKey = env('GOOGLE_MAPS_API_KEY');
        $mapsURL = 'https://maps.googleapis.com/maps/api/geocode/json?address='.$zip.'&key='.$googleAPIKey;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $mapsURL);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $geo = json_decode(curl_exec($ch), true);

        return $geo['results'][0]['geometry']['location'];
    }

    private function calculateDistance($pointA, $pointB)
    {
        $coordinate1 = new Coordinate($pointA['lat'], $pointA['long']);
        $coordinate2 = new Coordinate($pointB['lat'], $pointB['long']);

        $calculator = new Vincenty();
        $distance = $calculator->getDistance($coordinate1, $coordinate2);
        return $distance/1609.34;
    }

    /**
     * Gets the list of agents.
     *
     * @return array
     */
    private function getAgents()
    {
        $agents = array();
        $rawData = User::select('users.id', 'users.zip_code')
            ->leftJoin('roles', 'users.role_id', '=', 'roles.id')
            ->where('roles.slug', '=', 'agent')
            ->get();
        foreach ($rawData as $agent) {

            $locationData = $this->getZipGeo($agent->zip_code);
            $agents[] = [
                'id' => $agent->id,
                'lat' => $locationData['lat'],
                'long' => $locationData['lng']
            ];
        }
        return $agents;
    }

    /**
     * Gets the list of contacts.
     *
     * @return array
     */
    private function getContacts()
    {
        $contacts = array();
        $rawData = User::select('users.*')
            ->leftJoin('roles', 'users.role_id', '=', 'roles.id')
            ->where('roles.slug', '=', 'contact')
            ->get();
        foreach ($rawData as $contact) {

            $locationData = $this->getZipGeo($contact->zip_code);
            $contacts[] = [
                'id' => $contact->id,
                'name' => $contact->first_name.' '.$contact->last_name,
                'age' => $contact->age,
                'gender' => ($contact->gender=='M')?'Male':'Female',
                'zip_code' => $contact->zip_code,
                'lat' => $locationData['lat'],
                'long' => $locationData['lng']
            ];

        }
        return $contacts;
    }

    /**
     * Gets the closest contacts of an agent.
     *
     * @return array
     */
    private function getContactList()
    {
        $currentAgentID = Auth::user()->id;
        $agents = $this->getAgents();
        $contacts = $this->getContacts();
        $agentContacts = array();

        foreach ($contacts as $contact) {
            $agentsDistance = array();
            foreach ($agents as $agent) {
                $contactLocation = ['lat' => $contact['lat'], 'long' => $contact['long']];
                $agentLocation = ['lat' => $agent['lat'], 'long' => $agent['long']];
                $distance = $this->calculateDistance($contactLocation, $agentLocation);
                $agentsDistance[$agent['id']] = $distance;
            }
            asort($agentsDistance);
            reset($agentsDistance);
            $minor = key($agentsDistance);
            if ($minor == $currentAgentID) {
                $contact['distance'] = round($agentsDistance[$minor], 2);
                $agentContacts[] = $contact;
            }
        }
        return $agentContacts;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $contactsList = $this->getContactList();
        return view('agentcontacts', ['contacts' => $contactsList]);
    }
}
