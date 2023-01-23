<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Collaborator;

class CollaboratorsController extends Controller
{

    protected function hasNewData($collaborator, $request)
    {
        $hasNewData = false;

        $dataArray = [
            'clientName' => $request->clientName,
            'cpf' => $request->cpf,
            'admissionDate' => $request->admissionDate,
            'cep' => $request->cep,
            'uf' => $request->uf,
            'city' => $request->city,
            'district' => $request->district,
            'address' => $request->address,
            'number' => $request->number,
            'complement' => $request->complement,
            'occupation' => $request->occupation,
        ];

        foreach ($dataArray as $dataItem => $val) {
            if ($collaborator->$dataItem != $val) {
                $hasNewData = true;
            }
        }

        return $hasNewData;
    }

    protected function verifyIfExists($id)
    {
        $exists = false;
        $collaborator = Collaborator::find($id);
        $collaborator && $exists = true;
        return $exists;
    }

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

    protected function validateFields($request, $type)
    {
        $type == 'post' ? 
            $validation = $request->validate([
                "id" => "required|min:36|max:36",
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
                    "id.required" => $this->returnRequiredMessage("id"),
                    "clientName.required" => $this->returnRequiredMessage("clientName"),
                    "cpf.required" => $this->returnRequiredMessage("cpf"),
                    "admissionDate.required" => $this->returnRequiredMessage("admissionDate"),
                    "cep.required" => $this->returnRequiredMessage("cep"),
                    "uf.required" => $this->returnRequiredMessage("uf"),
                    "city.required" => $this->returnRequiredMessage("city"),
                    "district.required" => $this->returnRequiredMessage("district"),
                    "address.required" => $this->returnRequiredMessage("address"),
                    "number.required" => $this->returnRequiredMessage("number"),
                    "occupation.required" => $this->returnRequiredMessage("occupation"),
                ]) :
            $validation = $request->validate([
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
                    "clientName.required" => $this->returnRequiredMessage("clientName"),
                    "cpf.required" => $this->returnRequiredMessage("cpf"),
                    "admissionDate.required" => $this->returnRequiredMessage("admissionDate"),
                    "cep.required" => $this->returnRequiredMessage("cep"),
                    "uf.required" => $this->returnRequiredMessage("uf"),
                    "city.required" => $this->returnRequiredMessage("city"),
                    "district.required" => $this->returnRequiredMessage("district"),
                    "address.required" => $this->returnRequiredMessage("address"),
                    "number.required" => $this->returnRequiredMessage("number"),
                    "occupation.required" => $this->returnRequiredMessage("occupation"),
                ]);
    }

    public function getAll()
    {
        $all = Collaborator::all();
        return response()->json($all);
    }

    public function getById($id)
    {
        $collaborator = Collaborator::find($id);
        if ($collaborator) {
            return response()->json($collaborator);
        } else {
            abort(400, 'Não existe nenhum colaborador com o código informado!');
        }

    }

    public function newCollaborator(Request $request)
    {
        $onSuccessMessage = "Dados inseridos com sucesso!";
        $this->validateFields($request, 'post');

        $collaboratorExists = $this->verifyIfExists($request->id);
        if (!$collaboratorExists) {
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

        } else {
            return abort(400, 'O colaborador já foi cadastrado!');
        }
    }

    public function editCollaborator(Request $request, $id)
    {
        $onSuccessMessage = "Os dados do colaborador foram atualizados com sucesso!";
        $this->validateFields($request, 'put');
        $collaborator = Collaborator::find($id);
        if ($collaborator) {
            if ($this->hasNewData($collaborator, $request)) {
                try {

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

                    return response()->json(['message' => $onSuccessMessage, 'data' => $request->all()]);
                } catch (\Exception $erro) {
                    return ['message' => 'error', 'details' => $erro];
                }
            } else {
                abort(400, 'Não existe nenhuma atualização de dados no registro');
            }

        } else {
            abort(400, 'Não existe nenhum colaborador com o código informado!');
        }
    }

    public function deleteCollaborator($id)
    {
        $collaborator = Collaborator::find($id);
        if ($collaborator) {
            try {
                $collaborator->delete();
                return response()->json(['message' => 'O colaborador foi deletado com sucesso!']);
            } catch (\Exception $erro) {
                return ['message' => 'error', 'details' => $erro];
            }

        } else {
            abort(400, 'Não existe nenhum colaborador com o código informado!');
        }
    }


}