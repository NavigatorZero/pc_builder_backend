<?php
 namespace App\DTO;

 use Symfony\Component\Validator\Constraints as Assert;

 class UserDto extends Dto
 {

    /**
     * @Assert\Sequentially({
     *     @Assert\NotBlank,
     *     @Assert\Type("string")
     * })
     */
    public string $name;

     /**
      * @Assert\Sequentially({
      *     @Assert\NotBlank,
      *     @Assert\Type("string")
      * })
      */
     public string $email;

     /**
      * @Assert\Sequentially({
      *     @Assert\Type("int")
      * })
      */
     public ?int $google_id = null;

     /**
      * @Assert\Sequentially({
      *     @Assert\Type("string")
      * })
      */
     public ?string $profile_image = null;

     /**
      * @Assert\Sequentially({
      *     @Assert\NotBlank,
      *     @Assert\Type("string")
      * })
      */
     public string $password;


 }
