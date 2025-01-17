<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ModalTest extends DuskTestCase
{
    /** @test */
    public function it_can_show_a_modal()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/modal/base')
                ->resize(1024, 768)
                ->waitForText('ModalComponent')
                ->click('@one')
                ->waitForText('ModalComponentOne')
                ->pause(500)
                ->screenshot('ModalComponentOne')
                ->click('@close-one')
                ->waitUntilMissingText('ModalComponentOne')
                ->pause(500)
                ->screenshot('ModalComponentOneClosed');

            $this->assertScreenshotSnapshot([
                'ModalComponentOne',
                'ModalComponentOneClosed',
            ]);
        });
    }

    /** @test */
    public function it_can_do_nested_modals()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/modal/base')
                ->resize(1024, 768)
                ->waitForText('ModalComponent')
                ->click('@one')
                ->waitForText('ModalComponentOne')
                ->click('@two')
                ->waitForText('ModalComponentTwo')
                ->pause(500)
                ->screenshot('ModalComponentTwo')
                ->click('@close-two')
                ->waitUntilMissingText('ModalComponentTwo')
                ->pause(500)
                ->screenshot('ModalComponentTwoClosed');

            $this->assertScreenshotSnapshot([
                'ModalComponentTwo',
                'ModalComponentTwoClosed',
            ]);
        });
    }

    /** @test */
    public function it_can_show_a_slideover()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/modal/base')
                ->resize(1024, 768)
                ->waitForText('ModalComponent')
                ->click('@slideover')
                ->waitForText('ModalComponentSlideover')
                ->pause(500)
                ->screenshot('ModalComponentSlideover')
                ->click('@close-slideover')
                ->waitUntilMissingText('ModalComponentSlideover')
                ->pause(500)
                ->screenshot('ModalComponentSlideoverClosed');

            $this->assertScreenshotSnapshot([
                'ModalComponentSlideover',
                'ModalComponentSlideoverClosed',
            ]);
        });
    }

    /** @test */
    public function it_can_do_nested_slideover()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/modal/base')
                ->resize(1024, 768)
                ->waitForText('ModalComponent')
                ->click('@slideover')
                ->waitForText('ModalComponentSlideover')
                ->pause(500)
                ->click('@one-from-slideover')
                ->waitForText('ModalComponentOne')
                ->pause(500)
                ->screenshot('ModalComponentSlideoverWithOne')
                ->click('@two')
                ->waitForText('ModalComponentTwo')
                ->pause(500)
                ->screenshot('ModalComponentSlideoverWithOneWithTwo')
                ->click('@close-two')
                ->waitUntilMissingText('ModalComponentTwo')
                ->pause(500)
                ->screenshot('ModalComponentSlideoverTwoClosed')
                ->click('@close-one')
                ->waitUntilMissingText('ModalComponentOne')
                ->pause(500)
                ->screenshot('ModalComponentSlideoverOneClosed')
                ->click('@close-slideover')
                ->waitUntilMissingText('ModalComponentSlideover')
                ->pause(500)
                ->screenshot('ModalComponentSlideoverClosed');

            $this->assertScreenshotSnapshot([
                'ModalComponentSlideoverWithOne',
                'ModalComponentSlideoverWithOneWithTwo',
                'ModalComponentSlideoverTwoClosed',
                'ModalComponentSlideoverOneClosed',
                'ModalComponentSlideoverClosed',
            ]);
        });
    }
}
