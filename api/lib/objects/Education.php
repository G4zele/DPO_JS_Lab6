<?php
class Education
{
    public $id_educ;
    public $id_candidate;
    public $degree;
    public $education_university;
    public $faculty;
    public $specialization;
    public $year_end;

    /**
     * @return mixed
     */
    public function getIdCandidate()
    {
        return $this->id_candidate;
    }

    /**
     * @param mixed $id_candidate
     */
    public function setIdCandidate($id_candidate)
    {
        $this->id_candidate = $id_candidate;
    }

    /**
     * @return mixed
     */
    public function getSpecialization()
    {
        return $this->specialization;
    }

    /**
     * @param mixed $specialization
     */
    public function setSpecialization($specialization)
    {
        $this->specialization = $specialization;
    }

    /**
     * @return mixed
     */
    public function getDegree()
    {
        return $this->degree;
    }

    /**
     * @param mixed $degree
     */
    public function setDegree($degree)
    {
        $this->degree = $degree;
    }

    /**
     * @return mixed
     */
    public function getEducationUniversity()
    {
        return $this->education_university;
    }

    /**
     * @param mixed $education_university
     */
    public function setEducationUniversity($education_university)
    {
        $this->education_university = $education_university;
    }

    /**
     * @return mixed
     */
    public function getFaculty()
    {
        return $this->faculty;
    }

    /**
     * @param mixed $year_end
     */
    public function setYearEnd($year_end)
    {
        $this->year_end = $year_end;
    }

    /**
     * @return mixed
     */
    public function getYearEnd()
    {
        return $this->year_end;
    }

    /**
     * @param mixed $faculty
     */
    public function setFaculty($faculty)
    {
        $this->faculty = $faculty;
    }

    /**
     * @return mixed
     */
    public function getIdEduc()
    {
        return $this->id_educ;
    }

    /**
     * @param mixed $id_educ
     */
    public function setIdEducations($id_educ)
    {
        $this->id_educ = $id_educ;
    }
}