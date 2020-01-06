<?php

namespace App\Http\Controllers;

use
    DataTables\Editor,
    DataTables\Editor\Field,
    DataTables\Editor\Format,
    DataTables\Editor\Mjoin,
    DataTables\Editor\Options,
    DataTables\Editor\Upload,
    DataTables\Editor\Validate,
    DataTables\Editor\ValidateOptions;


use DataTables\Database;
use Illuminate\Http\Request;


class TesteController extends Controller
{
    private $db,$editor;

    public function __construct()
    {
        $this->db = new Database( array(
            "type" => "Mysql",
            "pdo" =>  \DB::connection()->getPdo(),
        ) );

       $this->editor =  Editor::inst( $this->db, 'datatables_demo' )
            ->fields(
                Field::inst( 'first_name' )
                    ->validator( Validate::notEmpty( ValidateOptions::inst()
                        ->message( 'A first name is required' ) 
                    ) ),
                Field::inst( 'last_name' )
                    ->validator( Validate::notEmpty( ValidateOptions::inst()
                        ->message( 'A last name is required' )  
                    ) ),
                Field::inst( 'position' ),
                Field::inst( 'email' )
                    ->validator( Validate::email( ValidateOptions::inst()
                        ->message( 'Please enter an e-mail address' )   
                    ) ),
                Field::inst( 'office' ),
                Field::inst( 'extn' ),
                Field::inst( 'age' )
                    ->validator( Validate::numeric() )
                    ->setFormatter( Format::ifEmpty(null) ),
                Field::inst( 'salary' )
                    ->validator( Validate::numeric() )
                    ->setFormatter( Format::ifEmpty(null) ),
                Field::inst( 'start_date' )
                    ->validator( Validate::dateFormat( 'Y-m-d' ) )
                    ->getFormatter( Format::dateSqlToFormat( 'Y-m-d' ) )
                    ->setFormatter( Format::dateFormatToSql('Y-m-d' ) )
            );
    }
 

    public function teste(Request $request)
    {
    
     
       
        return view('teste');

       

    }

    public function ajax()
    {
        // $db = new Database( array(
        //     "type" => "Mysql",
        //     "pdo" =>  \DB::connection()->getPdo(),
        // ) );
        
        // Build our Editor instance and process the data coming from _POST
            $this->editor
            ->process( $_REQUEST )
            ->json();
    }
    // public function ajaxPost()
    // {
    //     // $db = new Database( array(
    //     //     "type" => "Mysql",
    //     //     "pdo" =>  \DB::connection()->getPdo(),
    //     // ) );
        
    //     // Build our Editor instance and process the data coming from _POST
    //         $this->editor
    //         ->process( $_REQUEST)
    //         ->json();
    // }
    // public function ajaxPut()
    // {
    //     // $db = new Database( array(
    //     //     "type" => "Mysql",
    //     //     "pdo" =>  \DB::connection()->getPdo(),
    //     // ) );
        
    //     // Build our Editor instance and process the data coming from _POST
    //         $this->editor
    //         ->process( $_REQUEST )
    //         ->json();
    // }
    // public function ajaxDelete()
    // {
    //     // $db = new Database( array(
    //     //     "type" => "Mysql",
    //     //     "pdo" =>  \DB::connection()->getPdo(),
    //     // ) );
        
    //     // Build our Editor instance and process the data coming from _POST
    //         $this->editor
    //         ->process( $_REQUEST )
    //         ->json();
    // }
}
