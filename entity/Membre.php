<?php

/**
 * Created by PhpStorm.
 * User: PC Dell
 * Date: 21/06/2017
 * Time: 09:29
 */
class Membre
{
    private $identifiant;

    private $nom;

    private $dateN;

    private $mail;

    private $mPasse;

    private $civilite;

    private $pays_id;

    private $pays_departement;

    private $sport;
    private $sport_id;
    private $img_id_profile;
    private $tel_fix;
    private $tel_mobile;
    private $sport_mecanique;

    private $categorie;

    /**
     * @return mixed
     */
    public function getIdentifiant()
    {
        return $this->identifiant;
    }

    /**
     * @param mixed $identifiant
     */
    public function setIdentifiant($identifiant)
    {
        $this->identifiant = $identifiant;
    }

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return mixed
     */
    public function getDateN()
    {
        return $this->dateN;
    }

    /**
     * @param mixed $dateN
     */
    public function setDateN($dateN)
    {
        $this->dateN = $dateN;
    }

    /**
     * @return mixed
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * @param mixed $mail
     */
    public function setMail($mail)
    {
        $this->mail = $mail;
    }

    /**
     * @return mixed
     */
    public function getMPasse()
    {
        return $this->mPasse;
    }

    /**
     * @param mixed $mPasse
     */
    public function setMPasse($mPasse)
    {
        $this->mPasse = $mPasse;
    }

    /**
     * @return mixed
     */
    public function getCivilite()
    {
        return $this->civilite;
    }

    /**
     * @param mixed $civilite
     */
    public function setCivilite($civilite)
    {
        $this->civilite = $civilite;
    }

    /**
     * @return mixed
     */
    public function getPaysId()
    {
        return $this->pays_id;
    }

    /**
     * @param mixed $pays_id
     */
    public function setPaysId($pays_id)
    {
        $this->pays_id = $pays_id;
    }

    /**
     * @return mixed
     */
    public function getPaysDepartement()
    {
        return $this->pays_departement;
    }

    /**
     * @param mixed $pays_departement
     */
    public function setPaysDepartement($pays_departement)
    {
        $this->pays_departement = $pays_departement;
    }

    /**
     * @return mixed
     */
    public function getSport()
    {
        return $this->sport;
    }

    /**
     * @param mixed $sport
     */
    public function setSport($sport)
    {
        $this->sport = $sport;
    }

    /**
     * @return mixed
     */
    public function getSportId()
    {
        return $this->sport_id;
    }

    /**
     * @param mixed $sport_id
     */
    public function setSportId($sport_id)
    {
        $this->sport_id = $sport_id;
    }

    /**
     * @return mixed
     */
    public function getImgIdProfile()
    {
        return $this->img_id_profile;
    }

    /**
     * @param mixed $img_id_profile
     */
    public function setImgIdProfile($img_id_profile)
    {
        $this->img_id_profile = $img_id_profile;
    }

    /**
     * @return mixed
     */
    public function getTelFix()
    {
        return $this->tel_fix;
    }

    /**
     * @param mixed $tel_fix
     */
    public function setTelFix($tel_fix)
    {
        $this->tel_fix = $tel_fix;
    }

    /**
     * @return mixed
     */
    public function getTelMobile()
    {
        return $this->tel_mobile;
    }

    /**
     * @param mixed $tel_mobile
     */
    public function setTelMobile($tel_mobile)
    {
        $this->tel_mobile = $tel_mobile;
    }

    /**
     * @return mixed
     */
    public function getSportMecanique()
    {
        return $this->sport_mecanique;
    }

    /**
     * @param mixed $sport_mecanique
     */
    public function setSportMecanique($sport_mecanique)
    {
        $this->sport_mecanique = $sport_mecanique;
    }

    /**
     * @return mixed
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * @param mixed $categorie
     */
    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;
    }






}