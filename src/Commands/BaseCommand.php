<?php

namespace LaPress\BlogFront\Commands;

use Illuminate\Console\Command;

/**
 * @author    Sebastian Szczepański
 * @copyright ably
 */
class BaseCommand extends Command
{
    /**
     * @param string $icon
     * @param string $text
     */
    public function icon(string $icon, string $text, $comment = null)
    {
        $text = "<info>{$icon}</info>  <comment>{$text}</comment> ";

        if ($comment) {
            $text = $text."($comment)";
        }
        $this->output->writeln($text);
    }
}
