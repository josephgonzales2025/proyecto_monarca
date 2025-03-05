<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Company;
use App\Models\Individual;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class clientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getClients()
    {
        $clients = Client::with(['individual','company'])->get();

        if($clients->isEmpty()){
            return response()->json(['message' => 'No se encontraron clientes'],404);
        }

        return response()->json($clients);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function createClient(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'client_type' => 'required|in:individual,company',
            'individual.name' => 'required_if:client_type,individual|string|max:255',
            'individual.dni' => 'required_if:client_type,indiviualna|digits:8|unique:individuals,dni',
            'company.company_name' => 'required_if:client_type,company|string|max:255',
            'company.ruc' => 'required_if:client_type,company|digits:11|unique:companies,ruc'
        ]);

        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()], 422);
        }

        return DB::transaction(function () use ($request) {
            $client = Client::create([
                'client_type' => $request->client_type
            ]);

            if ($request->client_type === 'individual') {
                Individual::create([
                    'client_id' => $client->id,
                    'name' => $request->individual['name'],
                    'dni' => $request->individual['dni'],
                    'email' => $request->individual['email'] ?? null,
                    'cellphone' => $request->individual['cellphone'] ?? null,
                    'address' => $request->individual['address'] ?? null
                ]);
            }

            else {
                Company::create([
                    'client_id' => $client->id,
                    'company_name' => $request->company['company_name'],
                    'ruc' => $request->company['ruc'],
                    'email' => $request->company['email'] ?? null,
                    'cellphone' => $request->company['cellphone'] ?? null,
                    'address' => $request->company['address'] ?? null
                ]);
            }
            
            return response()->json(['message' => 'Cliente registrado correctamente'], 201);

            
        });

    }

    /**
     * Display the specified resource.
     */
    public function getClientById($id)
    {
        $client = Client::with(['individual','company'])->find($id);

        if(!$client){
            return response()->json(['message' => 'Cliente no encontrado'], 404);
        }

        return response()->json($client);

    }

    /**
     * Update the specified resource in storage.
     */
    public function updateClientById(Request $request, $id)
    {
        $client = Client::with(['individual', 'company'])->find($id);

        if (!$client) {
            return response()->json(['message' => 'Cliente no encontrado'], 404);
        }
    
        $rules = [];
    
        if ($client->client_type === 'individual') {
            $rules = [
                'individual.name' => 'required|string|max:255',
                'individual.dni' => 'required|digits:8|unique:individuals,dni,' . optional($client->individual)->id,
                'individual.email' => 'nullable|email|max:255',
                'individual.cellphone' => 'nullable|string|max:20',
                'individual.address' => 'nullable|string|max:255',
            ];
        } else {
            $rules = [
                'company.company_name' => 'required|string|max:255',
                'company.ruc' => 'required|digits:11|unique:empresas,ruc,' . optional($client->company)->id,
                'company.email' => 'nullable|email|max:255',
                'company.cellphone' => 'nullable|string|max:20',
                'company.address' => 'nullable|string|max:255',
            ];
        }
    
        $request->validate($rules);
    
        return DB::transaction(function () use ($request, $client) {
            if ($client->client_type === 'individual' && $client->individual) {
                $client->individual->fill($request->individual)->save();
            } elseif ($client->client_type === 'company' && $client->company) {
                $client->company->fill($request->company)->save();
            }
    
            return response()->json(['message' => 'Cliente actualizado correctamente']);
        });
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function deleteClientById($id)
    {
        $client = Client::with(['individual','company'])->find($id);

        if(!$client){
            return response()->json(['message' => 'Cliente no encontrado'], 404);
        }

        $client->delete();

        return response()->json(['message' => 'Cliente eliminado'], 200);
    }
}
