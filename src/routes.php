<?php

use Slim\Http\Request;
use Slim\Http\Response;

// Routes

// DEBUT GET -------------------------------------------------------------------------
// Utilisateur
$app->get('/user/[{login}/{password}]', function (Request $request, Response $response, array $args) {
    $sth = $this->db->prepare("SELECT id FROM utilisateur WHERE login=:login AND password=:password");
    $sth->bindParam("login", $args['login']);
    $sth->bindParam("password", $args['password']);
    $sth->execute();
    $utilisateur = $sth->fetchObject();
    return $this->response->withJson($utilisateur);
});

// Cookies de l'utilisateur
$app->get('/cookies/[{id}]', function (Request $request, Response $response, array $args) {
    $sth = $this->db->prepare("SELECT cookies FROM utilisateur WHERE id=:id");
    $sth->bindParam("id", $args['id']);
    $sth->execute();
    $cookies = $sth->fetchObject();
    return $this->response->withJson($cookies);
});

// Classement utilisateur/cookies (10 premiers)
$app->get('/rank', function (Request $request, Response $response, array $args) {
    $sth = $this->db->prepare("SELECT pseudo, cookies FROM utilisateur ORDER BY cookies DESC LIMIT 3");
    $sth->execute();
    $rank = $sth->fetchAll();
    return $this->response->withJson($rank);
});
// FIN GET

// DEBUT POST -----------------------------------------------------------
// Ajout d'un magasin
// $app->post('/magasin', function ($request, $response) {
//     $input = $request->getParsedBody();
//     $sql = "INSERT INTO `magasin`(`dateajout`, `enseigne`, `site`, `adresse`, `ville`, `CP`, `responsable`, `telephone`, `contact`, `fax`, `caisses`, `nombre`, `telemaintenance`, `idutilisateur`, `lundiDebut`, `lundiFin`, `mardiDebut`, `mardiFin`, `mercrediDebut`, `mercrediFin`, `jeudiDebut`, `jeudiFin`, `vendrediDebut`, `vendrediFin`, `samediDebut`, `samediFin`, `dimancheDebut`, `dimancheFin`) 
//             VALUES (:dateajout, :enseigne, :site, :adresse, :ville, :CP, :responsable, :telephone, :contact, :fax, :caisses, :nombre, :telemaintenance, :idutilisateur, :lundiDebut, :lundiFin, :mardiDebut, :mardiFin, :mercrediDebut, :mercrediFin, :jeudiDebut, :jeudiFin, :vendrediDebut, :vendrediFin, :samediDebut, :samediFin, :dimancheDebut, :dimancheFin);";
//     $sth = $this->db->prepare($sql);
//     $sth->bindParam("dateajout", $input['dateajout']);
//     $sth->bindParam("enseigne", $input['enseigne']);
//     $sth->bindParam("site", $input['site']);
//     $sth->bindParam("adresse", $input['adresse']);
//     $sth->bindParam("ville", $input['ville']);
//     $sth->bindParam("CP", $input['CP']);
//     $sth->bindParam("responsable", $input['responsable']);
//     $sth->bindParam("telephone", $input['telephone']);
//     $sth->bindParam("contact", $input['contact']);
//     $sth->bindParam("fax", $input['fax']);
//     $sth->bindParam("caisses", $input['caisses']);
//     $sth->bindParam("nombre", $input['nombre']);
//     $sth->bindParam("telemaintenance", $input['telemaintenance']);
//     $sth->bindParam("idutilisateur", $input['idutilisateur']);
//     $sth->bindParam("lundiDebut", $input['lundiDebut']);
//     $sth->bindParam("lundiFin", $input['lundiFin']);
//     $sth->bindParam("mardiDebut", $input['mardiDebut']);
//     $sth->bindParam("mardiFin", $input['mardiFin']);
//     $sth->bindParam("mercrediDebut", $input['mercrediDebut']);
//     $sth->bindParam("mercrediFin", $input['mercrediFin']);
//     $sth->bindParam("jeudiDebut", $input['jeudiDebut']);
//     $sth->bindParam("jeudiFin", $input['jeudiFin']);
//     $sth->bindParam("vendrediDebut", $input['vendrediDebut']);
//     $sth->bindParam("vendrediFin", $input['vendrediFin']);
//     $sth->bindParam("samediDebut", $input['samediDebut']);
//     $sth->bindParam("samediFin", $input['samediFin']);
//     $sth->bindParam("dimancheDebut", $input['dimancheDebut']);
//     $sth->bindParam("dimancheFin", $input['dimancheFin']);
//     $sth->execute();
//     return $this->response->withJson($input);
// });
// FIN POST

// DEBUT PUT
// Modification du nombre de cookies
$app->put('/cookies/[{id}/{cookies}]', function ($request, $response, $args) {
    $input = $request->getParsedBody();
    $sql = "UPDATE `utilisateur` SET `cookies`= :cookies
                                WHERE `id`=:id";
    $sth = $this->db->prepare($sql);
    $sth->bindParam("cookies", $args['cookies']);
    $sth->bindParam("id", $args['id']);
    $sth->execute();
    return $this->response->write('modifié');
});
// FIN PUT

// DEBUT DELETE
// Suppression magasin
// $app->delete('/magasin/[{id}]', function ($request, $response, $args) {
//     $sth = $this->db->prepare("DELETE FROM `magasin` WHERE id=:id");
//     $sth->bindParam("id", $args['id']);
//     $sth->execute();
//     return $this->response->write('Supprimé');
// });
// FIN DELETE