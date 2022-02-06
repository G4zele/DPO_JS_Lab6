<?php


class Candidate
{
    public $id_candidate;
    public $profession;
    public $city;
    public $photo;
    public $tel;
    public $full_name;
    public $email;
    public $birthday;
    public $wage;
    public $skills;
    public $about;
    public $status;
    public $age;

    // Get

    /**
     * @return mixed
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * @return mixed
     */
    public function getIdCandidate()
    {
        return $this->id_candidate;
    }

    /**
     * @return mixed
     */
    public function getProfession()
    {
        return $this->profession;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @return mixed
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * @return mixed
     */
    public function getTel()
    {
        return $this->tel;
    }

    /**
     * @return mixed
     */
    public function getFullName()
    {
        return $this->full_name;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * @return mixed
     */
    public function getWage()
    {
        return $this->wage;
    }

    /**
     * @return mixed
     */
    public function getSkills()
    {
        return $this->skills;
    }

    /**
     * @return mixed
     */
    public function getAbout()
    {
        return $this->about;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    // Set

    /**
     * @param mixed $id_candidate
     */
    public function setIdCandidate($id_candidate)
    {
        $this->id_candidate = $id_candidate;
    }

    /**
     * @param mixed $profession
     */
    public function setProfession($profession)
    {
        $this->profession = $profession;
    }

    /**
     * @param mixed $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * @param mixed $photo
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;
    }

    /**
     * @param mixed $tel
     */
    public function setTel($tel)
    {
        $this->tel = $tel;
    }

    /**
     * @param mixed $full_name
     */
    public function setFullName($full_name)
    {
        $this->full_name = $full_name;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @param mixed $birthday
     */
    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;
    }

    /**
     * @param mixed $wage
     */
    public function setWage($wage)
    {
        $this->wage = $wage;
    }

    /**
     * @param mixed $skills
     */
    public function setSkills($skills)
    {
        $this->skills = $skills;
    }

    /**
     * @param mixed $about
     */
    public function setAbout($about)
    {
        $this->about = $about;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @param mixed $age
     */
    public function setAge($age)
    {
        $this->age = $age;
    }
}