<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactIssue extends Model
{
    // Update fillable fields to use user_name
    protected $fillable = ['user_name', 'phone', 'problem_type', 'problem_description'];
}
