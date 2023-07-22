<?PHP
    @session_start();
    include_once('./vendor/autoload.php');

    use Firebase\JWT\JWT;
    use Firebase\JWT\Key;

    if(!isset($_SESSION['auth-admin'])){
        header('Location: index');
    }
    $key = 'ffcgmksaccn13244349ismsd$dsdsmasdfs1324#';
    $jwt = $_SESSION['auth-admin'];
    try{
        $decoded = JWT::decode($jwt, new Key($key, 'HS256'));
        // if($decoded->data->role != 1){
        //     header("Location: ./");
        // }
    }catch(\Firebase\JWT\ExpiredException $e){
         echo 'Caught exception: ',  $e->getMessage(), "\n";
         header("Location: login.php");
    }
    
    // echo time();    
    // echo $jwt."\n";
    // echo '
    // <h2 class="mt-4">Decode</h2>';
    // echo '<pre>';
    // print_r($decoded);
    // echo '</pre>';
    
     $template->assign_vars(array(

		"auth_uid" => $decoded->data->id,
		"auth_name" => $decoded->data->name,

	));
  

    function calculateAge($birthdate) {
        $today = new DateTime();
        $birthDate = new DateTime($birthdate);
        $ageInterval = $today->diff($birthDate);
    
        $ageYears = $ageInterval->y;
        $ageMonths = $ageInterval->m;
        $ageDays = $ageInterval->d;
    
        return array('years' => $ageYears, 'months' => $ageMonths, 'days' => $ageDays);
    }
    

    $branch = Db::queryAll('SELECT * FROM tb_branch  WHERE deleted_at IS NULL ORDER BY branch_id DESC');

    for($z=0; $z<count($branch); $z++)
    {


        $template->assign_block_vars('branchGlobal',array(

            "num" => ($z+1),
            "id" => $branch[$z]['branch_id'],
            "name" => $branch[$z]['branch_name'],
            "date" => $branch[$z]['created_at'],


        ));

        
    }
?>