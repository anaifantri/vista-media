<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::define('isAdmin', function($user){
            return $user->level === 'Administrator';
        });
        Gate::define('isMedia', function($user){
            return $user->level === 'Media';
        });
        Gate::define('isMarketing', function($user){
            return $user->level === 'Marketing';
        });
        Gate::define('isAccounting', function($user){
            return $user->level === 'Accounting';
        });
        Gate::define('isWorkshop', function($user){
            return $user->level === 'Workshop';
        });
        Gate::define('isOwner', function($user){
            return $user->level === 'Owner';
        });

        //Gate Media --> start
        Gate::define('isLocation', function($user){
            $roles = json_decode($user->user_access);
            if($roles){
                foreach ($roles->objMedia->mediaRoles as $mediaRole){
                    if ($mediaRole->access == true && $mediaRole->title == 'Data Lokasi'){
                        return true;
                    }
                }
            }
        });

        Gate::define('isArea', function($user){
            $roles = json_decode($user->user_access);
            if($roles){
                foreach ($roles->objMedia->mediaRoles as $mediaRole){
                    if ($mediaRole->access == true && $mediaRole->title == 'Data Area'){
                        return true;
                    }
                }
            }
        });

        Gate::define('isLegal', function($user){
            $roles = json_decode($user->user_access);
            if($roles){
                foreach ($roles->objMedia->mediaRoles as $mediaRole){
                    if ($mediaRole->access == true && $mediaRole->title == 'Data Legalitas'){
                        return true;
                    }
                }
            }
        });

        Gate::define('isMediaSetting', function($user){
            $roles = json_decode($user->user_access);
            if($roles){
                foreach ($roles->objMedia->mediaRoles as $mediaRole){
                    if ($mediaRole->access == true && $mediaRole->title == 'Pengaturan'){
                        return true;
                    }
                }
            }
        });

        Gate::define('isMediaCreate', function($user){
            $roles = json_decode($user->user_access);
            if($roles){
                return $roles->objMedia->permissions->create == true;
            }
        });

        Gate::define('isMediaRead', function($user){
            $roles = json_decode($user->user_access);
            if($roles){
                return $roles->objMedia->permissions->read == true;
            }
        });

        Gate::define('isMediaEdit', function($user){
            $roles = json_decode($user->user_access);
            if($roles){
                return $roles->objMedia->permissions->update == true;
            }
        });

        Gate::define('isMediaDelete', function($user){
            $roles = json_decode($user->user_access);
            if($roles){
                return $roles->objMedia->permissions->delete == true;
            }
        });
        //Gate Media --> end

        //Gate Marketing --> start
        Gate::define('isVendor', function($user){
            $roles = json_decode($user->user_access);
            if($roles){
                foreach ($roles->objMarketing->marketingRoles as $marketingRole){
                    if ($marketingRole->access == true && $marketingRole->title == 'Data Vendor'){
                        return true;
                    }
                }
            }
        });

        Gate::define('isClient', function($user){
            $roles = json_decode($user->user_access);
            if($roles){
                foreach ($roles->objMarketing->marketingRoles as $marketingRole){
                    if ($marketingRole->access == true && $marketingRole->title == 'Data Klien'){
                        return true;
                    }
                }
            }
        });

        Gate::define('isQuotation', function($user){
            $roles = json_decode($user->user_access);
            if($roles){
                foreach ($roles->objMarketing->marketingRoles as $marketingRole){
                    if ($marketingRole->access == true && $marketingRole->title == 'Penawaran'){
                        return true;
                    }
                }
            }
        });

        Gate::define('isSale', function($user){
            $roles = json_decode($user->user_access);
            if($roles){
                foreach ($roles->objMarketing->marketingRoles as $marketingRole){
                    if ($marketingRole->access == true && $marketingRole->title == 'Penjualan'){
                        return true;
                    }
                }
            }
        });

        Gate::define('isOrder', function($user){
            $roles = json_decode($user->user_access);
            if($roles){
                foreach ($roles->objMarketing->marketingRoles as $marketingRole){
                    if ($marketingRole->access == true && $marketingRole->title == 'SPK'){
                        return true;
                    }
                }
            }
        });

        Gate::define('isQuotationReport', function($user){
            $roles = json_decode($user->user_access);
            if($roles){
                foreach ($roles->objMarketing->marketingRoles as $marketingRole){
                    if ($marketingRole->access == true && $marketingRole->title == 'Lap. Penawaran'){
                        return true;
                    }
                }
            }
        });

        Gate::define('isSaleReport', function($user){
            $roles = json_decode($user->user_access);
            if($roles){
                foreach ($roles->objMarketing->marketingRoles as $marketingRole){
                    if ($marketingRole->access == true && $marketingRole->title == 'Lap. Penjualan'){
                        return true;
                    }
                }
            }
        });

        Gate::define('isOrderReport', function($user){
            $roles = json_decode($user->user_access);
            if($roles){
                foreach ($roles->objMarketing->marketingRoles as $marketingRole){
                    if ($marketingRole->access == true && $marketingRole->title == 'Lap. SPK'){
                        return true;
                    }
                }
            }
        });

        Gate::define('isMarketingSetting', function($user){
            $roles = json_decode($user->user_access);
            if($roles){
                foreach ($roles->objMarketing->marketingRoles as $marketingRole){
                    if ($marketingRole->access == true && $marketingRole->title == 'Pengaturan'){
                        return true;
                    }
                }
            }
        });

        Gate::define('isMarketingCreate', function($user){
            $roles = json_decode($user->user_access);
            if($roles){
                return $roles->objMarketing->permissions->create == true;
            }
        });

        Gate::define('isMarketingRead', function($user){
            $roles = json_decode($user->user_access);
            if($roles){
                return $roles->objMarketing->permissions->read == true;
            }
        });

        Gate::define('isMarketingEdit', function($user){
            $roles = json_decode($user->user_access);
            if($roles){
                return $roles->objMarketing->permissions->update == true;
            }
        });

        Gate::define('isMarketingDelete', function($user){
            $roles = json_decode($user->user_access);
            if($roles){
                return $roles->objMarketing->permissions->delete == true;
            }
        });
        //Gate Marketing --> end

        //Gate Accounting --> start
        Gate::define('isCollect', function($user){
            $roles = json_decode($user->user_access);
            if($roles){
                foreach ($roles->objAccounting->accountingRoles as $accountingRole){
                    if ($accountingRole->access == true && $accountingRole->title == 'Penagihan'){
                        return true;
                    }
                }
            }
        });

        Gate::define('isPayment', function($user){
            $roles = json_decode($user->user_access);
            if($roles){
                foreach ($roles->objAccounting->accountingRoles as $accountingRole){
                    if ($accountingRole->access == true && $accountingRole->title == 'Pembayaran'){
                        return true;
                    }
                }
            }
        });

        Gate::define('isPPN', function($user){
            $roles = json_decode($user->user_access);
            if($roles){
                foreach ($roles->objAccounting->accountingRoles as $accountingRole){
                    if ($accountingRole->access == true && $accountingRole->title == 'Faktur PPN'){
                        return true;
                    }
                }
            }
        });

        Gate::define('isPPh', function($user){
            $roles = json_decode($user->user_access);
            if($roles){
                foreach ($roles->objAccounting->accountingRoles as $accountingRole){
                    if ($accountingRole->access == true && $accountingRole->title == 'Faktur PPh'){
                        return true;
                    }
                }
            }
        });

        Gate::define('isAccountingCreate', function($user){
            $roles = json_decode($user->user_access);
            if($roles){
                return $roles->objAccounting->permissions->create == true;
            }
        });

        Gate::define('isAccountingRead', function($user){
            $roles = json_decode($user->user_access);
            if($roles){
                return $roles->objAccounting->permissions->read == true;
            }
        });

        Gate::define('isAccountingEdit', function($user){
            $roles = json_decode($user->user_access);
            if($roles){
                return $roles->objAccounting->permissions->update == true;
            }
        });

        Gate::define('isAccountingDelete', function($user){
            $roles = json_decode($user->user_access);
            if($roles){
                return $roles->objAccounting->permissions->delete == true;
            }
        });
        //Gate Accounting --> end

        //Gate Workshop --> start
        Gate::define('isElectricity', function($user){
            $roles = json_decode($user->user_access);
            if($roles){
                foreach ($roles->objWorkshop->workshopRoles as $workshopRole){
                    if ($workshopRole->access == true && $workshopRole->title == 'Data Listrik'){
                        return true;
                    }
                }
            }
        });
        Gate::define('isComplaint', function($user){
            $roles = json_decode($user->user_access);
            if($roles){
                foreach ($roles->objWorkshop->workshopRoles as $workshopRole){
                    if ($workshopRole->access == true && $workshopRole->title == 'Komplain'){
                        return true;
                    }
                }
            }
        });

        Gate::define('isMonitoring', function($user){
            $roles = json_decode($user->user_access);
            if($roles){
                foreach ($roles->objWorkshop->workshopRoles as $workshopRole){
                    if ($workshopRole->access == true && $workshopRole->title == 'Pemantauan'){
                        return true;
                    }
                }
            }
        });

        Gate::define('isDocumentation', function($user){
            $roles = json_decode($user->user_access);
            if($roles){
                foreach ($roles->objWorkshop->workshopRoles as $workshopRole){
                    if ($workshopRole->access == true && $workshopRole->title == 'Pemasangan'){
                        return true;
                    }
                }
            }
        });

        Gate::define('isContent', function($user){
            $roles = json_decode($user->user_access);
            if($roles){
                foreach ($roles->objWorkshop->workshopRoles as $workshopRole){
                    if ($workshopRole->access == true && $workshopRole->title == 'Konten'){
                        return true;
                    }
                }
            }
        });

        Gate::define('isWorkshopCreate', function($user){
            $roles = json_decode($user->user_access);
            if($roles){
                return $roles->objWorkshop->permissions->create == true;
            }
        });

        Gate::define('isWorkshopRead', function($user){
            $roles = json_decode($user->user_access);
            if($roles){
                return $roles->objWorkshop->permissions->read == true;
            }
        });

        Gate::define('isWorkshopEdit', function($user){
            $roles = json_decode($user->user_access);
            if($roles){
                return $roles->objWorkshop->permissions->update == true;
            }
        });

        Gate::define('isWorkshopDelete', function($user){
            $roles = json_decode($user->user_access);
            if($roles){
                return $roles->objWorkshop->permissions->delete == true;
            }
        });
        //Gate Workshop --> end

        //Gate user --> start
        Gate::define('isUserMenu', function($user){
            $roles = json_decode($user->user_access);
            if($roles){
                foreach ($roles->objUser->userRoles as $userRole){
                    if ($userRole->access == true && $userRole->title == 'Pengguna'){
                        return true;
                    }
                }
            }
        });

        Gate::define('isUserCreate', function($user){
            $roles = json_decode($user->user_access);
            if($roles){
                return $roles->objUser->permissions->create == true;
            }
        });

        Gate::define('isUserRead', function($user){
            $roles = json_decode($user->user_access);
            if($roles){
                return $roles->objUser->permissions->read == true;
            }
        });

        Gate::define('isUserEdit', function($user){
            $roles = json_decode($user->user_access);
            if($roles){
                return $roles->objUser->permissions->update == true;
            }
        });

        Gate::define('isUserDelete', function($user){
            $roles = json_decode($user->user_access);
            if($roles){
                return $roles->objUser->permissions->delete == true;
            }
        });
        //Gate user --> end
    }
}
