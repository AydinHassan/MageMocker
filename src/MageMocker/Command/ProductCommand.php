<?php

namespace MageMocker\Command;

use Symfony\Component\Console\Input\InputArgument;

/**
 * Class ProductCommand
 * @package MageMocker\Command
 * @author Aydin Hassan <aydin@hotmail.co.uk>
 *
 * Command to add products to Magento
 */
class ProductCommand extends AbstractCommand implements CommandInterface
{

    /**
     * Setup command
     */
    public function configure()
    {
        parent::configure();

        $this->setName('magemocker:product')
             ->setDescription('Create Fake Magento products')
             ->addArgument(
                 'type_id',
                 InputArgument::REQUIRED,
                 'Product Type Id'
             )
             ->addArgument(
                 'website_id',
                 InputArgument::REQUIRED,
                 'Website Id'
             )
             ->addArgument(
                 'store_id',
                 InputArgument::REQUIRED,
                 'Store Id'
             )
             ->addArgument(
                 'attribute_set_id',
                 InputArgument::REQUIRED,
                 'Attribute Set Id'
             )
             ->addArgument(
                 'amount',
                 InputArgument::REQUIRED,
                 'Amount of products to add'
             )
             ->addArgument(
                 'category_ids',
                 InputArgument::IS_ARRAY | InputArgument::REQUIRED,
                 "Category Id's To assign the product to (separate multiple ID's with a space)"
             );
    }
} 