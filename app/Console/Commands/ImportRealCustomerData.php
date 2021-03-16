<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use League\Csv\Reader;

class ImportRealCustomerData extends Command
{


    protected $signature = 'import:customer_real_data
    {customerFilename : Source file of Products to import}';


    protected $description = 'Batch-import of real csv data for tech test';

    public function handle()
    {

        $this->info('Starting batch import...');


        try {
            $data = $this->getData($this->argument('customerFilename'));
        } catch (\Exception $e) {
            $this->error("ERROR: Failed to retrieve data from source file - " . $e->getMessage());
            return;
        }

        $total = count($data);

        $this->comment("Found $total consumables");

        $results = [
            'success' => 0,
            'fail' => 0
        ];

        $requiredProps = [
            'codeId',
        ];

        foreach ($data as $index => $item) {
            $progressString = '#' . $index . ' of ' . $total;

            try {

                $customer = \App\Models\Customer::create($item);

                $results['success']++;
                $this->info("$progressString successful (ID " . $customer->ref . ")");
            } catch (\Exception $e) {
                $results['fail']++;
                $this->error("$progressString failed: " . $e->getMessage());
            }
        }

        $completed = "PROCESS COMPLETED: " . $results['success'] . " successful / " . $results['fail'] . " failed";
        if ($results['fail'] === 0) {
            $this->info($completed);
        } else {
            $this->error($completed);
        }
    }


    protected function getData(string $path)
    {
        $csv = Reader::createFromPath($path);
        $csv->setHeaderOffset(0);

        return $csv;
    }
}
