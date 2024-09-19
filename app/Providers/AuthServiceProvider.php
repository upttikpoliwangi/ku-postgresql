<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;

use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
		
		if (! $this->app->routesAreCached()) {
            Passport::routes();
        }

		Passport::tokensCan([
			'readonly' => 'ReadOnly',
			'crud' => 'CRUD',
		]);
		
		if (Schema::hasTable('roles')) {			
			$roles = \Spatie\Permission\Models\Role::where('guard_name','web')->get();
			foreach($roles as $r){
				$nama=$r->name;				
				Gate::define($nama, function ($user) use ($nama) {
					return $user->role_aktif==$nama;
				});
				
			}
		}
		
		/*Gate::before(function ($user) {
			$roles = \Spatie\Permission\Models\Role::where('guard_name','web')->get();
			$ur=$user->role_aktif;
			$urada=false;
            foreach($roles as $r){
				if($r->name==$ur){
					$urada=true;	
					break;
				}
            }
			Gate::define($ur, function ($user) use ($urada) {
				echo $user->role_aktif." ".($urada?"ada":"tidak")."---";
				return $urada;
			});
        });*/
		/*Gate::define('operator', function ($user) {
			//$roles = $user->roles->pluck('name')->toArray();
			$role = $user->role_aktif;
			if ($role == 'operator'){
               return true;
			}
			return false;
       });
	   
	   Gate::define('admin', function ($user) {
			$role = $user->role_aktif;
			if ($role == 'admin'){
			return true;
			}
			return false;
       });
	   
	   Gate::define('pengusul', function ($user) {
           $roles = $user->roles->pluck('name')->toArray();
			$role = $user->role_aktif;
			if(count($roles)<1)return false;
			if ($roles[$role] == 'pengusul'){
               return true;
			}
			return false;
       });
	   
	   Gate::define('operator', function ($user) {
           $roles = $user->roles->pluck('name')->toArray();
			$role = $user->role_aktif;
			if(count($roles)<1)return false;
			if ($roles[$role] == 'operator'){
               return true;
			}
			return false;
       });
	   
	   Gate::define('p3m', function ($user) {
           $roles = $user->roles->pluck('name')->toArray();
			$role = $user->role_aktif;
			if(count($roles)<1)return false;
			if ($roles[$role] == 'p3m'){
               return true;
			}
			return false;
       });
	   
	   Gate::define('direktur', function ($user) {
           $roles = $user->roles->pluck('name')->toArray();
			$role = $user->role_aktif;
			if(count($roles)<1)return false;
			if ($roles[$role] == 'direktur'){
               return true;
			}
			return false;
       });
	   
	   Gate::define('kaprodi', function ($user) {
           $roles = $user->roles->pluck('name')->toArray();
			$role = $user->role_aktif;
			if(count($roles)<1)return false;
			if ($roles[$role] == 'kaprodi'){
               return true;
			}
			return false;
       });*/
	   
        //
    }
}
