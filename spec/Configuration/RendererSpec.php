<?php

namespace spec\Indigo\Supervisor\Configuration;

use Indigo\Supervisor\Configuration;
use Indigo\Supervisor\Configuration\Section;
use PhpSpec\ObjectBehavior;

class RendererSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Indigo\Supervisor\Configuration\Renderer');
    }

    function it_renders_a_configuration(Configuration $configuration, Section $section)
    {
        $configuration->getSections()->willReturn([$section]);
        $section->getName()->willReturn('section');
        $section->getProperties()->willReturn([
            'key1' => 'value',
            'key2' => true,
            'key3' => ['val1', 'val2', 'val3'],
        ]);

        $this->render($configuration)->shouldReturn("[section]\nkey1 = value\nkey2 = true\nkey3 = val1,val2,val3\n\n");
    }

    function it_renders_a_section(Section $section)
    {
        $section->getName()->willReturn('section');
        $section->getProperties()->willReturn([
            'key1' => 'value',
            'key2' => true,
            'key3' => ['val1', 'val2', 'val3'],
        ]);

        $this->renderSection($section)->shouldReturn("[section]\nkey1 = value\nkey2 = true\nkey3 = val1,val2,val3\n\n");
    }
}
