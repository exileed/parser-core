<?php

namespace App\Interfaces;

/**
 * Interface ParserClientConfiguratorInterface
 * @package App\Interfaces
 */
interface ParserClientConfiguratorInterface
{
    const PROTOCOL = 'https';
    const HOST = 'rbc.ru';
    const MAX_POSTS_LIMIT = 15;
    const SELECTOR_POST_IN_LIST = 'a.news-feed__item';
    const SELECTOR_POST_TITLE = '.article__header__title h1';
    const SELECTOR_POST_BODY = '.article__text';
    const SELECTOR_POST_IMAGE = 'img.article__main-image__image';
    const SELECTOR_POST_BANNER = '.banner';

    /**
     * @return string
     */
    public function getProtocol(): string;


    /**
     * @return string
     */
    public function getHost(): string;


    /**
     * @return int
     */
    public function getAmountPosts(): int;


    /**
     * @return string
     */
    public function getSelectorPostInList(): string;


    /**
     * @return string
     */
    public function getSelectorPostDetailTitle(): string;


    /**
     * @return string
     */
    public function getSelectorPostDetailBody(): string;


    /**
     * @return string
     */
    public function getSelectorPostDetailImage(): string;


    /**
     * @return string
     */
    public function getSelectorPostDetailBanner(): string;
}
