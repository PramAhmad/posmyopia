<?php

namespace App\Console\Commands;

use Binafy\LaravelStub\Facades\LaravelStub;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Pluralizer;

class CrudCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:crud {name} {--table=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'CRUD Generator';

    protected $exceptField = ['id', 'created_at', 'updated_at'];

    /**
     * Execute the console command.
     */
    public function handle()
    {
        LaravelStub::from(app_path() . '/Stubs/Controllers/controller.stub')
                    ->to(app_path(). '/Http/Controllers')
                    ->name(ucwords(Pluralizer::singular($this->argument('name') . 'Controller')))
                    ->ext('php')
                    ->replaces([
                        'name' => strtolower($this->argument('name')),
                        'model' => Pluralizer::singular($this->argument('name')),
                        'caps_name' => Pluralizer::singular($this->argument('name'))
                    ])
                    ->generate();

        $this->generateView();
        $this->generateModel();
        $this->generateDatatables();
    }

    private function tableColumn()
    {
        return DB::select("SHOW COLUMNS FROM " . $this->option('table'));
    }

    /**
     * GENERATE VIEW
     */
    private function generateView()
    {
        $viewPath = base_path(). '/resources/views/' . strtolower($this->argument('name'));

        if (!is_dir($viewPath)) {
            mkdir($viewPath, 0777, TRUE);
        }

        LaravelStub::from(app_path() . '/Stubs/Views/index.stub')
                    ->to($viewPath)
                    ->name('index')
                    ->ext('blade.php')
                    ->replaces([
                        'name' => strtolower($this->argument('name')),
                        'caps_name' => Pluralizer::singular($this->argument('name')),
                        'fields' => $this->generateInputField()
                    ])
                    ->generate();
                    
        LaravelStub::from(app_path() . '/Stubs/Views/datatable-actions.stub')
                    ->to(base_path(). '/resources/views/datatable-actions')
                    ->name(strtolower($this->argument('name')))
                    ->ext('blade.php')
                    ->replaces([
                        'name' => strtolower($this->argument('name')),
                    ])
                    ->generate();

        LaravelStub::from(app_path() . '/Stubs/Js/js.stub')
        ->to(base_path(). '/resources/js/page')
        ->name(strtolower($this->argument('name')))
        ->ext('js')
        ->replaces([
            'name' => strtolower($this->argument('name')),
        ])
        ->generate();
    }

    private function generateInputField()
    {
        $fields = '';

        foreach ($this->tableColumn() as $column) {
            if (in_array($column->Field, $this->exceptField)) {
                continue;
            }

            $isRequired = $column->Null == 'NO' ? 'required' : '';

            $fields.= '<div class="form-group mb-2">
                    <x-inputs.input id="'. $column->Field. '" name="'. $column->Field. '" label="'. ucwords(str_replace('_', ' ',$column->Field)). '" '. $isRequired .'/>
                </div>
                ';
        }

        return rtrim($fields, '
        ');
    }
    
    /**
     * GENERATE MODEL
     */
    private function generateModel()
    {
        LaravelStub::from(app_path() . '/Stubs/Models/model.stub')
                    ->to(app_path(). '/Models')
                    ->name(ucwords(Pluralizer::singular($this->argument('name'))))
                    ->ext('php')
                    ->replaces([
                        'caps_name' => Pluralizer::singular($this->argument('name')),
                        'fillable' => $this->generateFillable()
                    ])
                    ->generate();
    }

    private function generateFillable()
    {
        $fillable = '';

        foreach ($this->tableColumn() as $column) {
            if (in_array($column->Field, $this->exceptField)) {
                continue;
            }

            $fillable .= "'$column->Field', ";
        }


        return '[' . rtrim($fillable, ', ') . ']';
    }
    
    /**
     * GENERATE DATATABLES 
     */
    private function generateDatatables()
    {
        LaravelStub::from(app_path() . '/Stubs/DataTables/datatable.stub')
                    ->to(app_path(). '/DataTables')
                    ->name(ucwords(Pluralizer::singular($this->argument('name'))) . 'DataTable')
                    ->ext('php')
                    ->replaces([
                        'name' => strtolower($this->argument('name')),
                        'model' => Pluralizer::singular($this->argument('name')),
                        'caps_name' => Pluralizer::singular($this->argument('name')),
                        'columns' => $this->generateDatatablesColumn()
                    ])
                    ->generate();
    }

    private function generateDatatablesColumn()
    {
        $columns = '';

        foreach ($this->tableColumn() as $column) {
            if (in_array($column->Field, $this->exceptField)) {
                continue;
            }

            $columns .= "Column::make('$column->Field'),
            ";
        }

        return rtrim($columns, '
        ');
    }
}
