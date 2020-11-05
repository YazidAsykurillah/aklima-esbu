<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MasterDataIntegrator extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'integrator:master-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to integrate all master data from GATRIK';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info($this->description);
        if ($this->confirm('Do you wish to continue?')) {
            $this->call('integrator:fetch-bentuk-badan-usaha');
            $this->call('integrator:fetch-jenis-usaha');
            $this->call('integrator:fetch-bidang');
            $this->call('integrator:fetch-sub-bidang');
            $this->call('integrator:fetch-matriks-kualifikasi');
            $this->call('integrator:fetch-provinsi');
            $this->call('integrator:fetch-kota');
            $this->call('integrator:fetch-kecamatan');
            $this->call('integrator:fetch-kelurahan');
            $this->call('integrator:fetch-lsbu-wilayah');
            $this->call('integrator:fetch-lingkup-pekerjaan-lsbu');
            $this->call('integrator:fetch-asesor');
            $this->call('integrator:fetch-badan-usaha');

            $this->info('');
            $this->info('Finished integrate all master data from GATRIK');
        }else{
            $this->info('Exited');
        }
    }
}
