<?php

namespace CPASimUSante\ItemSelectorBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration as EXT;
use Symfony\Component\BrowserKit\Response;

/**
 * Class ItemSelectorController
 *
 * @category   Controller
 * @package    CPASimUSante
 * @subpackage ItemSelector
 * @author     CPASimUSante <contact@simusante.com>
 * @copyright  2015 CPASimUSante
 * @license    http://www.opensource.org/licenses/mit-license.php MIT License
 * @version    0.1
 * @link       http://simusante.com
 *
 * @EXT\Route(
 *      "/",
 *      name    = "cpasimusante_itemselector",
 *      service = "cpasimusante_itemselector.controller.itemselector"
 * )
 */
class ItemSelectorController extends Controller
{
    /**
     * @EXT\Route("/index", name="cpasimusante_itemselector_index")
     * @return Response
     * @throws \Exception
     */
    public function indexAction()
    {
        throw new \Exception('hello');
    }
}
