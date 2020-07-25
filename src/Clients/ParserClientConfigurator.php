<?php

namespace App\Clients;

use App\Interfaces\ParserClientConfiguratorInterface;

/**
 * Class ParserClientConfigurator
 * @package App\Clients
 */
class ParserClientConfigurator implements ParserClientConfiguratorInterface
{
    /**
     * @inheritdoc
     */
    public function getProtocol(): string
    {
        return ParserClientConfiguratorInterface::PROTOCOL;
    }

    /**
     * @inheritdoc
     */
    public function getHost(): string
    {
        return ParserClientConfiguratorInterface::HOST;
    }

    /**
     * @inheritdoc
     */
    public function getAmountPosts(): int
    {
        return ParserClientConfiguratorInterface::MAX_POSTS_LIMIT;
    }

    /**
     * @inheritdoc
     */
    public function getSelectorPostInList(): string
    {
        return ParserClientConfiguratorInterface::SELECTOR_POST_IN_LIST;
    }

    /**
     * @inheritdoc
     */
    public function getSelectorPostDetailTitle(): string
    {
        return ParserClientConfiguratorInterface::SELECTOR_POST_TITLE;
    }

    /**
     * @inheritdoc
     */
    public function getSelectorPostDetailBody(): string
    {
        return ParserClientConfiguratorInterface::SELECTOR_POST_BODY;
    }

    /**
     * @inheritdoc
     */
    public function getSelectorPostDetailImage(): string
    {
        return ParserClientConfiguratorInterface::SELECTOR_POST_IMAGE;
    }

    /**
     * @inheritdoc
     */
    public function getSelectorPostDetailBanner(): string
    {
        return ParserClientConfiguratorInterface::SELECTOR_POST_BANNER;
    }
}