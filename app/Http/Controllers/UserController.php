<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UpdateEmailRequest;
use App\Http\Requests\UpdateRequest;
use App\Models\Client;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class UserController extends Controller
{
    public function index()
    {
        $clientid =   0;
        $user = User::with('client')->find(auth()->user()->id);
        $client = Client::where('id', $user->client_id)->first();
        $count = Client::all()->count();

        if (!$client) {
            $clientid = $count + 1;
        }
        return Inertia::render('Client/Account', [
            'user' => $user,
            'client_Id' => $clientid
        ]);
    }

    public function update(UpdateRequest $request)
    {
        $validated = $request->validated();

        $checkEmail = User::find(auth()->user()->id);
        $client = Client::find($validated['clientId']);
        if ($client) {
            $client->fname = $validated['fname'];
            $client->mname = $validated['mname'] ?? null;
            $client->lname = $validated['lname'];
            $client->sex = $validated['sex'];
            $client->street = $validated['street'] ?? null;
            $client->brgy = $validated['brgy'];
            $client->municipality = $validated['municipality'];
            $client->province = $validated['province'];
            if ($client->update()) {
                $user = User::find($validated['userId']);
                if ($checkEmail != $validated['email']) {
                    $user->email = $validated['email'] ?? null;
                }
                if ($validated['password']) {
                    $user->password = $validated['password'];
                }
                $user->isAdmin = $validated['type'];
                $user->contact_number =  $validated['contact_number'];
                $user->username = $validated['fname'];
                if ($user->update()) {
                    $users = User::where('email', $validated['email'])
                        ->orWhere('contact_number', $validated['email'])
                        ->where('isAdmin', 0)
                        ->first();
                    Auth::login($users);
                    $request->session()->put("fName", $client->fname); // Add client's first name to session
                    $request->session()->regenerate();
                    return redirect()->route('account');
                }
            }
        } else {
            $clients = Client::create([
                'fname' => $validated['fname'],
                'mname' => $validated['mname'] ?? null,
                'lname' => $validated['lname'],
                'sex' => $validated['sex'],
                'street' => $validated['street'] ?? null,
                'brgy' => $validated['brgy'],
                'municipality' => $validated['municipality'],
                'province' => $validated['province']
            ]);
            // die($client->fname);
            if ($clients) {
                $users = User::find($validated['userId']);
                if ($checkEmail != $validated['email']) {
                    $users->email = $validated['email'] ?? null;
                }
                if ($validated['password']) {
                    $users->password = $validated['password'];
                }
                $users->client_id = $clients->id;
                $users->isAdmin = $validated['type'];
                $users->contact_number =  $validated['contact_number'];
                $users->username = $validated['fname'];
                if ($users->update()) {
                    $users1 = User::where('email', $validated['email'])
                        ->orWhere('contact_number', $validated['email'])
                        ->where('isAdmin', 0)
                        ->first();
                    Auth::login($users1);
                    $request->session()->put("fName", $clients->fname); // Add client's first name to session
                    $request->session()->regenerate();
                    return redirect()->route('account');
                }
            }         
        }
    }
}
