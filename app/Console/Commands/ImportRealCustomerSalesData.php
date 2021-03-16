<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use League\Csv\Reader;

class ImportRealCustomerSalesData extends Command
{


    protected $signature = 'import:customer_sales_real_data
    {customerSalesFilename : Source file of Customer Sales to import}';


    protected $description = 'Batch-import of real csv data for tech test';

    public function handle()
    {

        $this->info('Starting batch import...');


        try {
            $data = $this->getData($this->argument('customerSalesFilename'));
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

        foreach ($data as $index => $item) {
            $progressString = '#' . $index . ' of ' . $total;

            try {

                $customerSale = \App\Models\CustomerSale::create($item);

                $results['success']++;
                $this->info("$progressString successful (ID " . $customerSale->id . ")");
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
