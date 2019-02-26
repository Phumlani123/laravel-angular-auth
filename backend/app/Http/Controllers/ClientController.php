<?php

namespace App\Http\Controllers;

use App\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    
   public function postClient(Request $request)
   {
       $client = new Client();
       $client->name = $request->input('name');
       $client->save();
       return response()->json(['client' => $client], 201);
   }
   public function getClients()
   {
       $clients = Client::all();
       $response = [
         'clients' => $clients
       ];
       return response()->json($response, 200);
   }
   public function putClient(Request $request, $id)
   {
       $client = Client::find($id);
       if (!$client) {
           return response()->json(['message' => 'Document not found'], 404);
       }
       $client->name = $request->input('name');
       $client->save();
       return response()->json(['client' => $client], 200);
   }
   public function deleteClient($id)
   {
       $client = Client::find($id);
       $client->delete();
       return response()->json(['message' => 'Client deleted'], 200);
   }

   public function getClient($id)
   {
       $client = Client::find($id);
       
       $response = [
        'client' => $client
      ];
      return response()->json($response, 200);
   }
}
