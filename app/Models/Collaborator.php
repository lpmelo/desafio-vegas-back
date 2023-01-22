<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collaborator extends Model
{
    use HasFactory;
    public $timestamps = false;
    private int $id;
    private string $clientName;
    private string $cpf;
    private string $admissionDate;
    private string $cep;
    private string $uf;
    private string $city;
    private string $district;
    private string $address;
    private string $number;
    private string $complement;
    private string $occupation;

}