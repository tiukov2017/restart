<?php
/**
 * Created by PhpStorm.
 * User: eran
 * Date: 30/05/16
 * Time: 19:16
 */

namespace App\Services;



use App\User;
use Mockery\CountValidator\Exception;



class UserService
{
    /**
     * UserService constructor.
     */
    public function __construct(User $user)
    {
        $this->dao = $user;
    }

    /**
     * @desc Return all the Users
     * @return User[]
     */
    function getAll(){

        $users = $this->dao->all();
        return $users;
    }

    /**
     * @param $id
     * @param $request
     * @return bool
     */
    function update($id,$request){

        $user = User::find($id);
        $name = $request->get('name');
        $phone = $request->get('user-phone');
        $role = $request->get('role');
        $status = $request->get('user-status');

        try{

            if(!is_null($name) && !empty($name)){
                $user->name = $name;
            }
            if(!is_null($phone) && !empty($name)){
                $user->phone = $phone;
            }
            if(!is_null($role) && !empty($name) && !$this->hasRole($user,$role)){
                $this->removeRole($user,$this->getRole($user));
                $this->assignRole($user,$role);
            }
            if(!is_null($status) && !empty($name)){
                $user->status = $status;
            }
            $user->save();
            return true;
        }
        catch(Exception $e){
            return false;
        }
    }

    /**
     * @param $id
     * @return \App\User;
     */
    public function getUserById($id){

       $user =  $this->dao->find($id);
        return $user;
    }

    public function getUsersByRole($role){

        $userByType =[];
        $users = $this->getAll();

        foreach($users as $user){
            if($this->hasRole($user,$role)){
               array_push($userByType,$user);
            }
        }
        return $userByType;
    }

   public function assignRole($user,$role){

       $user->assignRole($role);
   }

    public function removeRole($user,$role){

        $user->removeRole($role);
    }

    public function getRole($user){

       return $user->getRole();

    }

    public function hasRole($user,$role){

        return $user->hasRole($role);
    }


}