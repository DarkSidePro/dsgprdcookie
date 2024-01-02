<?php
    namespace DarkSide\DsGprdCookie\Entity;

    use Doctrine\ORM\Mapping as ORM;


    /**
     * @ORM\Table()
     * @ORM\Entity(repositoryClass="DarkSide\DsGprdCookie\Repository\CookieInCategoryRepository")
     * @ORM\HasLifecycleCallbacks
     */
    class DsGprdCookieInCategory 
    {
        /**
         * @var int
         * @ORM\Id
         * @ORM\GeneratedValue
         * @ORM\Column(type="integer")
         */
        private int $id;

        /**
         * @var null|DsGprdCookie
         * 
         * @ORM\ManyToOne(targetEntity=DsGprdCookie::class, inversedBy="cookie_in_categories")
         * @ORM\JoinColumn(nullable=false)
         */
        private null|DsGprdCookie $cookie;

        /**
         * @var null|DsGprdCookieCategory
         * 
         * @ORM\ManyToOne(targetEntity=DsGprdCookieCategory::class, inversedBy="dsGprdCookieInCategories")
         * @ORM\JoinColumn(nullable=false)
         */
        private null|DsGprdCookieCategory $category;

        /**
         * @return int
         */
        public function getId(): int
        {
            return $this->id;
        }

        /**
         * @return DsGprdCookie
         */
        public function getCookie(): DsGprdCookie
        {
            return $this->cookie;
        }

        /**
         * @param null|DsGprdCookie $cookie
         * 
         * @return self
         */
        public function setCookie(?DsGprdCookie $cookie): self
        {
            $this->cookie = $cookie;

            return $this;
        }

        /**
         * @return null|DsGprdCategory
         */
        public function getCategory(): DsGprdCookieCategory
        {
            return $this->category;
        }

        /**
         * @param null|DsGprdCategory
         * 
         * @return self
         */
        public function setCategory(?DsGprdCookieCategory $category): null|self
        {
            $this->category = $category; 

            return $this;
        }
    }