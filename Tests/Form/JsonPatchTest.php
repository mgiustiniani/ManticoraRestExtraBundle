<?php
/**
 * User: Mario Giustiniani
 * Date: 12/04/14
 * Time: 16.27
 */

namespace Manticora\RestExtraBundle\Tests\Form;

use Manticora\RestExtraBundle\Form\JsonPatchLineType;
use Manticora\RestExtraBundle\Form\JsonPatchType;
use Symfony\Component\Form\Test\TypeTestCase;
class JsonPatchTest extends TypeTestCase{


    /**
     * @test
     * @group unit
     */
    public function TestJsonPatch(){

        $targetDocument = '{"a":{"b":["c","d","e"]}}';

        $patchDocument = '[
      {"op":"add", "path":"/a/d", "value":["a","b"]},
      {"op":"test", "path":"/a/d/-", "value":"b"},
      {"op":"remove", "path":"/a/d/-"},
      {"op":"test", "path":"/a/d/-", "value":"a"},
      {"op":"add", "path":"/a/d/-", "value":"b"},
      {"op":"test", "path":"/a/d", "value":["a","b"]},
      {"op":"move", "path":"/a/c", "from":"/a/d"},
      {"op":"test", "path":"/a/c", "value":["a","b"]},
      {"op":"copy", "path":"/a/e", "from":"/a/c"},
      {"op":"test", "path":"/a/e", "value":["a","b"]},
      {"op":"replace", "path":"/a/e", "value":["a"]},
      {"op":"test", "path":"/a/e", "value":["a"]}
    ]';
        $document = json_decode($patchDocument);
        $patchDocument = '[
      {"op":"test", "path":"/a/d/-", "value":"b"}
    ]';

        $patchDocument = '[
      {"op":"add", "path":"/a/d", "value":["a","b"]},
      {"op":"test", "path":"/a/d/-", "value":"b"},
      {"op":"remove", "path":"/a/d/-"},
      {"op":"test", "path":"/a/d/-", "value":"a"},
      {"op":"add", "path":"/a/d/-", "value":"b"},
      {"op":"test", "path":"/a/d", "value":["a","b"]},
      {"op":"move", "path":"/a/c", "from":"/a/d"},
      {"op":"test", "path":"/a/c", "value":["a","b"]},
      {"op":"copy", "path":"/a/e", "from":"/a/c"},
      {"op":"test", "path":"/a/e", "value":["a","b"]},
      {"op":"replace", "path":"/a/e", "value":["a"]},
      {"op":"test", "path":"/a/e", "value":["a"]}
    ]';
        $document = json_decode($patchDocument, true);

        $this->assertJson($targetDocument);
        $this->assertJson($patchDocument);




        $type = new JsonPatchType();
        $form = $this->factory->create($type);

        // invia direttamente i dati al form
        $form->submit($document);
        $this->assertTrue($form->isSynchronized());
      //  $this->assertEquals($document, $form->getData());
        //$this->assertEquals($object, $form->getData());

        $view = $form->createView();
        $children = $view->children;

        $patchDocument = '{"op":"test", "path":"/a/d/-", "value":"b"}';
        $document = json_decode($patchDocument, true);
        $this->assertJson($patchDocument);






    }
} 