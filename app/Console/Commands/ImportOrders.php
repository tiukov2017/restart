<?php
/**
 * Created by PhpStorm.
 * User: eran
 * Date: 25/07/16
 * Time: 14:18
 */

namespace App\Console\Commands;


use App\Services\CrmApiService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\URL;

class ImportOrders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'orders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import orders from crm';

    protected $service;

    /**
     * @param CrmApiService $service
     */

    public function __construct(CrmApiService $service)
    {
        parent::__construct();
        $this->service = $service;
    }

    public function fire(){

        // Fix url path when the app sits in a subfolder
        // The problem was that laravel gets localhost instead of localhost/checknet/public
        URL::forceRootUrl( env('APP_URL') );

        $this->service->getOrdersByStatus(1);
    }


}