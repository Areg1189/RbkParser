<?php
namespace Parsers;

interface Parser{
    /**
     * Возвращает линк статьи
     * @param $dom
     * @return string
     */
    public function getPostLink($dom);

    /**
     * Возвращает заголовку статьи
     * @param $dom
     * @return string | boolean
     */
    public function getTitle($dom);

    /**
     * Возвращает подзаголовоку статьи
     * @param $dom
     * @return string | boolean
     */
    public function getSubTitle($dom);

    /**
     * Возвращает тело статьи
     * @param $dom
     * @return string | boolean
     */
    public function getSubBody($dom);

    /**
     * Возвращает фотографии статьи
     * @param $dom
     * @return array
     */
    public function getPostImages($dom);
}