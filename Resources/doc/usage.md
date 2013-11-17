# Usage

## XML HTTP Request Annotation

```` php
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Widop\FrameworkExtraBundle\Configuration\XmlHttpRequest;

class AnnotController extends Controller
{
    /**
     * @XmlHttpRequest
     */
    public function indexAction()
    {

    }
}
````

If the request is not an XML HTTP request, a `Symfony\Component\HttpKernel\Exception\NotFoundHttpException` is thrown.

## JSON Template Annotation

```` php
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Widop\FrameworkExtraBundle\Configuration\JsonTemplate;

class AnnotController extends Controller
{
    /**
     * @JsonTemplate
     */
    public function indexAction()
    {
        return array('foo' => 'bar');
    }
}
````

The response is automatically converted to a JSON response through the `Symfony\Component\HttpFoundation\JsonResponse`
class.
