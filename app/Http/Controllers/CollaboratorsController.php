<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CollaboratorsController extends Controller
{

    protected function returnRequiredMessage($fieldName)
    {
        $allMessages = [
            'id' => 'O parâmetro id é obrigatório!',
            'clientName' => 'O parâmetro clientName é obrigatório!',
            "cpf" => "O parâmetro cpf é obrigatório!",
            "admissionDate" => "O parâmetro admissionDate é obrigatório!",
            "cep" => "O parâmetro cep é obrigatório!",
            "uf" => "O parâmetro uf é obrigatório!",
            "city" => "O parâmetro city é obrigatório!",
            "district" => "O parâmetro district é obrigatório!",
            "address" => "O parâmetro address é obrigatório!",
            "number" => "O parâmetro number é obrigatório!",
            "occupation" => "O parâmetro occupation é obrigatório!",
        ];

        $requiredMessage = $allMessages[$fieldName];

        return $requiredMessage;
    }

    public function getAll()
    {
        $message = 'Olá a todos';
        return response()->json($message);
    }

    public function postNewCollaborator(Request $request)
    {
        $validation = $request->validate([
            "id" => "required",
            "clientName" => "required",
            "cpf" => "required",
            "deliveryDate" => "required",
            "cep" => "required",
            "uf" => "required",
            "city" => "required",
            "district" => "required",
            "address" => "required",
            "number" => "required",
            "occupation" => "required"
        ], [
                "id" => $this->returnRequiredMessage("id"),
                "clientName.required" => $this->returnRequiredMessage("clientName"),
                "cpf" => $this->returnRequiredMessage("cpf"),
                "admissionDate" => $this->returnRequiredMessage("admissionDate"),
                "cep" => $this->returnRequiredMessage("cep"),
                "uf" => $this->returnRequiredMessage("uf"),
                "city" => $this->returnRequiredMessage("city"),
                "district" => $this->returnRequiredMessage("district"),
                "address" => $this->returnRequiredMessage("address"),
                "number" => $this->returnRequiredMessage("number"),
                "occupation" => $this->returnRequiredMessage("occupation"),

            ]);

        return response()->json($request->all());
    }


}