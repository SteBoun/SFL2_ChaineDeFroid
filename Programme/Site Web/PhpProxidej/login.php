<?php

if(isset($_GET['action']) &&  $_GET['action']='login' && !empty($_POST)){
    $login = $_POST['login'];
    $password = $_POST['password'];
    
    $resultat = $connexion->query("SELECT * FROM 'user' WHERE login='$login' AND password='$password'");
    $resultat->setFetchMode(PDO::FETCH_OBJ);
    $user = $resultat->fetch();
    if($user){
        $_SESSION['errCode']=0;
        $_SESSION['prenom']=$user->prenom;
        $_SESSION['nom']=$user->nom;
        $_SESSION['role']=$user->role;
        header('location:index.php');
    }
    else{
        $_SESSION['errCode']=2;
        header('location:login.php');
        
    }
}
/*
 if(isset($_SESSION['role']) || $_SESSION['role']!=1){
     $_SESSION['errCode']=1;
     header('location:login.php');
 }
*/