<?php

namespace MageMocker\Command;

use Symfony\Component\Console\Input\InputArgument;

/**
 * Class AddToCartCommand
 * @package MageMocker\Command
 * @author Aydin Hassan <aydin@hotmail.co.uk>
 *
 * Command to add products to the cart
 */
class AddToCartCommand extends AbstractCommand implements CommandInterface {

    /**
     * Setup command
     */
    public function configure()
    {

        parent::configure();

        $this->setName('magemocker:addtocart')
            ->setDescription('Add Products To Your Cart')
            ->addArgument(
                'product_id',
                InputArgument::REQUIRED,
                'Product Id'
            )
            ->addArgument(
                'qty',
                InputArgument::REQUIRED,
                'Quantity'
            );
    }
}
