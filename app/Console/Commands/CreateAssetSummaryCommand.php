<?php

namespace App\Console\Commands;

use App\Models\Asset;
use App\Models\AssetSummary;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class CreateAssetSummaryCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'asset:summary';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new summary to assets.';
    protected $assets;

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
     * @return int
     */
    public function handle()
    {
        $this->loadAssets();

        foreach ($this->assets as $asset) {
            foreach ($asset->markets as $market) {
                try{
                    AssetSummary::create(($market->service())->summary($asset));
                }catch (\Throwable $e){
                    Log::error($e->getMessage());
                }
            }
        }

        return 0;
    }

    private function loadAssets()
    {
        $this->assets = Asset::all();
    }
}
