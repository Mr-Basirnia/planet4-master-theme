<?php

namespace P4\MasterTheme;

use Timber\Timber;

/**
 * Class TaxonomyCampaign
 */
class TaxonomyCampaign
{
    /**
     * Context
     *
     * @var array $context
     */
    public array $context = [];

    /**
     * Templates
     *
     * @var array $templates
     */
    protected array $templates = [];

    /**
     * TaxonomyCampaign constructor.
     *
     * @param array $templates An indexed array with template file names. The first to be found will be used.
     * @param array $context An associative array with all the context needed to render the template found first.
     */
    public function __construct(array $templates = [ 'archive.twig', 'index.twig' ], array $context = [])
    {
        $this->templates = $templates;
        $this->context = $context;
    }

    /**
     * Add a block to the Campaign template.
     *
     * @param string $block_name The name of the block to be added.
     * @param array  $block_attributes An associative array with data needed by the block.
     */
    public function add_block(string $block_name, array $block_attributes): void
    {

        if (!$block_name || !$block_attributes) {
            return;
        }

        if ('happy_point' === $block_name) {
            $block_name = 'happypoint';
        }

        $this->context['blocks'][] = '<!-- wp:planet4-blocks/' . $block_name . ' '
            . wp_json_encode($block_attributes, JSON_UNESCAPED_SLASHES)
            . ' /-->';
    }

    /**
     * View the Campaign template.
     */
    public function view(): void
    {
        Timber::render($this->templates, $this->context);
    }
}
