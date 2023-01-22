<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Collaborator;

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

    protected function validateFields($request)
    {
        $validation = $request->validate([
            "id" => "required",
            "clientName" => "required",
            "cpf" => "required",
            "admissionDate" => "required",
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
    }

    public function getAll()
    {
        $all = Collaborator::all();
        return response()->json($all);
    }

    public function newCollaborator(Request $request)
    {
        $onSuccessMessage = "Dados inseridos com sucesso!";
        $this->validateFields($request);

        try {

            $collaborator = new Collaborator();
            $collaborator->id = $request->id;
            $collaborator->clientName = $request->clientName;
            $collaborator->cpf = $request->cpf;
            $collaborator->admissionDate = $request->admissionDate;
            $collaborator->cep = $request->cep;
            $collaborator->uf = $request->uf;
            $collaborator->city = $request->city;
            $collaborator->district = $request->district;
            $collaborator->address = $request->address;
            $collaborator->number = $request->number;
            $collaborator->complement = $request->complement;
            $collaborator->occupation = $request->occupation;

            $collaborator->save();

            return response()->json(["message" => $onSuccessMessage]);

        } catch (\Exception $erro) {
            return ['message' => 'error', 'details' => $erro];
        }




        return response()->json($request->all());
    }


}