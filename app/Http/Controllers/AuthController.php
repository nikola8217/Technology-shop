<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserRole;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginIndex(){
        return view('auth.login');
    }

    public function registerIndex() {
        return view('auth.register');
    }

    public function register(Request $request) {
        $name = $request->name;
        $lastname = $request->lastname;
        $email = $request->email;
        $password = $request->password;
        $confrim_password = $request->confirm_password;

        $emailCheck = filter_var($email, FILTER_VALIDATE_EMAIL);

        if (empty($name)||empty($lastname)||empty($email)||empty($password)||empty($confrim_password)) {
            return response()->json(['error'=>'Morate popuniti sva polja!']);
        }

        else if($emailCheck === false){
            return response()->json(['error'=>'Email nije validan!']);
        }

        else if(User::where('email', '=', $email)->first()){
            return response()->json(['error'=>'Email je zauzet!']);
        } 

        else if(strlen($password) < 8){
            return response()->json(['error' => 'Šifra mora imati najmanje 8 karaktera!']);
        }

        else if ($password !== $confrim_password) {
            return response()->json(['error'=>'Šifre se ne poklapaju!']);
        }

        else {
            $user = User::register($name, $lastname, $email, $password);

            $userRole = UserRole::createUserRole($user->id, 1);

            return response()->json([
                'success'=>'Uspešno ste se registrovali!',
                'user' => $user,
                'userRole' => $userRole,
            ]);
        }

    }

    public function login(Request $request) {
        $email = $request->email;
        $password = $request->password;
       
        if (empty($email)||empty($password)) {
            return response()->json(['error'=> 'Morate popuniti sva polja!']);
        }

        else if (Auth::attempt($request->only('email', 'password'))) {
            
            $user = User::where('email', $email)->first();
            $role = UserRole::getRoleForUser($user->id);
            $countRole = count($role);
            $roles = UserRole::getRoles($user->id); 

           
            
            $this->saveSessionData($user);

            if(session('role_id') == 2) {
                return response()->json([
                    'successAdmin'=>'Dobrodosao admine!',
                    'user' => $user,
                    'count'=> $countRole,
                    'role' => $role,
                    'roles' => $roles
                    
                    
                ]);
            }

            else if(session('role_id') == 3) {
                return response()->json([
                    'successMen'=>'Dobrodosao menadzer!',
                    'user' => $user,
                    'count'=> $countRole,
                    'role' => $role,
                    'roles' => $roles
                    
                    
                ]);
            }

            // else if($countRole > 1) {
            //     return response()->json([
            //         'success'=>'Uspesno logovanje!',
            //         'user' => $user,
            //         'count'=> $countRole,
            //         'role' => $role->role_id,
            //         // 'roles' => $roles
                    
            //     ]);
            // }

            else {
                return response()->json([
                    'success'=>'Uspesno logovanje!',
                    'user' => $user,
                    'count'=> $countRole,
                    'role' => $role,
                    'roles' => $roles
                    
                ]);
            }
            
            // return response()->json([
            //     'success'=>'Uspesno logovanje!',
            //     'user' => $user,
            //     'count'=> $countRole,
            //     'role' => $role,
                
            // ]);
        }

        else {
            return response()->json(['error'=>'Podaci nisu validni!']);
        }
    }

    private function saveSessionData(User $user)
    {
        $role = UserRole::where('user_id','=',$user->id)->first();
        
        session(['role_id' => $role->role_id]);
    }

    public function users() {
        return view('admin.users');
    }

    public function getUsers() {
        $users = User::getUsers();

        if($users->first()){
            foreach($users as $user){
                
                $name = $user->name;
                $lastname = $user->lastname;
                $email = $user->email;
                $id = $user->id;  
                
                $userRole = UserRole::getRoles($id);

                // dd($userRole);

                $userRole = implode("<br>", $userRole);              
                                   
                $ret_users[] = (object) array("name" => $name, "lastname"=> $lastname, "email" => $email, "userRole"=> $userRole, "id" => $id);
                
            }

            return response()->json([
                'users' => $ret_users
                
            ]);
        }

    }

    public function getRoles() {
        $roles = Role::getRoles();

        return response()->json([
            'roles' => $roles
            
        ]);
    
    }

    public function createUser(Request $request) {
        $name = $request->name;
        $lastname = $request->lastname;
        $email = $request->email;
        $password = $request->password;
        $confrim_password = $request->confirm_password;
        $roles = $request->check_roles;

        $count = count($roles);

        $emailCheck = filter_var($email, FILTER_VALIDATE_EMAIL);

        if (empty($name)||empty($lastname)||empty($email)||empty($password)||empty($confrim_password)) {
            return response()->json(['error'=>'Morate popuniti sva polja!']);
        }

        else if($emailCheck === false){
            return response()->json(['error'=>'Email nije validan!']);
        }

        else if(User::where('email', '=', $email)->first()){
            return response()->json(['error'=>'Email je zauzet!']);
        } 

        else if(strlen($password) < 8){
            return response()->json(['error' => 'Šifra mora imati najmanje 8 karaktera!']);
        }

        else if ($password !== $confrim_password) {
            return response()->json(['error'=>'Šifre se ne poklapaju!']);
        }

        else if ($count < 1) {
            return response()->json(['error'=>'Morate izabrati najmanje jednu rolu!']);
        }

        else {
            $user = User::register($name, $lastname, $email, $password);

            // $userRole = UserRole::createUserRole($user->id, 1);

            foreach($roles as $r => $roleItem){
                $userRole = UserRole::updateOrCreate([
                    "user_id" => $user->id,
                    "role_id" => $roles[$r]
    
                ]);

                
            }

            return response()->json([
                'success'=>'Uspešno ste kreirali korisnika!',
                'user' => $user,
                'userRole' => $userRole,
            ]);

            
        }
    }

    public function editUser(Request $request) {
        $name = $request->name;
        $lastname = $request->lastname;
        $roles = $request->check_roles;
        $id = $request->id;

        $count = count($roles);

        if (empty($name)||empty($lastname)) {
            return response()->json(['error'=>'Morate popuniti sva polja!']);
        }

        else if ($count < 1) {
            return response()->json(['error'=>'Morate izabrati najmanje jednu rolu!']);
        }

        else {
            $user = User::editUser($id, $name, $lastname);

            // $userRole = UserRole::createUserRole($user->id, 1);

            foreach($roles as $r => $roleItem){
                $userRole = UserRole::updateOrCreate([
                    "user_id" => $id,
                    "role_id" => $roles[$r]
    
                ]);

                
            }

            return response()->json([
                'success'=>'Uspešno ste izmenili korisnika!',
                'user' => $user,
                // 'userRole' => $userRole,
            ]);
        }
    }

    public function deleteUser($id) {

        UserRole::where('user_id', $id)->delete();
        
        User::where('id', $id)->delete();
        

    }

    public function postaviSesijuRole(Request $request) 
    {
        
        $id = $request->id;
        // session(['role_id' => $id]);
        // $ses = session('role_id');

        $role = session(['role_id' => $id]);

        return response()->json([
            "role" => $role
        ]);
    }

    public function getPoints() {
        $user = User::getUser();

        return response()->json([
            "bodovi" => $user->brBodova
        ]);
    }

    public function profile() {
        return view('auth.profile');
    }

    public function getUserAuth() {
        $user = User::where('id', auth()->user()->id)->get();

        
        

        return response()->json([
            "user" => $user
        ]);
    }

    public function changePass(Request $request) {
        $old = $request->old;
        $pass = $request->pass;
        $conf = $request->conf;

        $passCheck = User::where('id', auth()->user()->id)->first();

        // dd($passCheck);

        if (empty($old)|| empty($pass) || empty($conf)) {
            return response()->json(['error'=>'Morate popuniti sva polja!']);
        }

        else if(strlen($pass) < 8){
            return response()->json(['error' => 'Šifra mora imati najmanje 8 karaktera!']);
        }

        else if ($pass !== $conf) {
            return response()->json(['error'=>'Šifre se ne poklapaju!']);
        }

        else {
            User::changePass(auth()->user()->id, $pass);

            return response()->json([
                'success'=>'Uspešno ste izmenili šifru!',
            ]);
        }

        




    }

    
}
