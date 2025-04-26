<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Controllers\API\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DialogflowController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $hook = $request->input('queryResult.intent.displayName');
        $categoryController = new CategoryController();

        switch ($hook) 
        {
            case 'Create Category':

                $data = new Request([
                    'name' => $request->input('queryResult.parameters.name'),
                    'description' => $request->input('queryResult.parameters.description'),
                ]);

                $response = $categoryController->store($data);
                // return $this->consume_EndPoint_Category('/api/categories', $request, 'POST');
            break;

            case 'Categories':
                $response = $categoryController->index();
                // return $this->consume_EndPoint_Category('/api/categories', $request, 'GET');
            break;

            case 'Show Category':
                $id = $request->input('queryResult.parameters.id');
                $response = $categoryController->show($id);
                // return $this->consume_EndPoint_Category("/api/categories/$id", $request, 'GET');
            break;

            case 'Available Products':
                $id = $request->input('queryResult.parameters.id');
                $response = $categoryController->show_available_products($id);
                // return $this->consume_EndPoint_Category("/api/categories/$id", $request, 'GET');
            break;

            default:
                return response()->json([
                    'FulfillmentText' => 'Unknown Hook'
                ]);
            break;
        }

        $originalResponse = $response->getData(true);
        return response()->json([
            'fulfillmentText' => $originalResponse,
            // 'data' => $originalResponse['data'] ?? null
        ]);
    }

    private function consume_EndPoint_Category($endpoint, $request, $method)
    {
        $URL = env('APP_URL');

        $http = Http::withHeaders([
            'Accept' => 'application/json',
        ]);

        try 
        {
            if(strtolower($method) === 'get') 
            {
                $response = $http->get($URL . $endpoint);
            }
            else
            {
                $data = [
                    'name' => $request->input('queryResult.parameters.name'),
                    'description' => $request->input('queryResult.parameters.description'),
                ];
                $response = $http->$method($URL . $endpoint, array_filter($data));
            }

            return response()->json([
                'fulfillmentText' => $response->json()['message'] ?? 'Success',
                'data' => $response->json()['data'] ?? 'Nothing to show'
            ]);
            
        } 
        catch (\Exception $ex) 
        {
            return response()->json([
                'fulfillmentText' => 'Error to process request.',
                'debug' => $ex->getMessage(),
            ]);
        }

    }

}
