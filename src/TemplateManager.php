<?php

use App\Context\ApplicationContext;
use App\Entity\Quote;
use App\Entity\Template;
use App\Entity\User;
use App\Repository\DestinationRepository;
use App\Repository\QuoteRepository;
use App\Repository\SiteRepository;

class TemplateManager
{
    /**
     * @param Template $tpl
     * @param array $data
     *
     * @return Template
     */
    public function getTemplateComputed(Template $tpl, array $data)
    {
        if (!$tpl) {
            throw new RuntimeException('no tpl given');
        }

        $replaced = clone($tpl);
        $replaced->subject = $this->computeText($replaced->subject, $data);
        $replaced->content = $this->computeText($replaced->content, $data);

        return $replaced;
    }

    /**
     * @param string $text
     * @param array $data
     *
     * @return string
     */
    protected function computeText($text, array $data)
    {
        $quote = (isset($data['quote']) && $data['quote'] instanceof Quote) ? $data['quote'] : null;
        if ($quote) {
            $quoteFromRepository = QuoteRepository::getInstance()->getById($quote->id);
            $usefulObject = SiteRepository::getInstance()->getById($quote->siteId);
            $destinationOfQuote = DestinationRepository::getInstance()->getById($quote->destinationId);

            if (contains($text, '[quote:destination_link]')) {
                $destination = DestinationRepository::getInstance()->getById($quote->destinationId);
            }

            $containsSummaryHtml = contains($text, '[quote:summary_html]');
            if ($containsSummaryHtml) {
                $text = str_replace(
                    '[quote:summary_html]',
                    Quote::renderHtml($quoteFromRepository),
                    $text
                );
            }

            $containsSummary = contains($text, '[quote:summary]');
            if ($containsSummary) {
                $text = str_replace(
                    '[quote:summary]',
                    Quote::renderText($quoteFromRepository),
                    $text
                );
            }

            if (contains($text, '[quote:destination_name]')) {
                $text = str_replace('[quote:destination_name]', $destinationOfQuote->countryName, $text);
            }
        }

        if (isset($destination, $usefulObject, $quoteFromRepository)) {
            $text = str_replace(
                '[quote:destination_link]',
                $usefulObject->url . '/' . $destination->countryName . '/quote/' . $quoteFromRepository->id,
                $text
            );
        } else {
            $text = str_replace('[quote:destination_link]', null, $text);
        }

        $appContext = ApplicationContext::getInstance();
        $user = (isset($data['user']) && ($data['user'] instanceof User))
                    ? $data['user']
                    : $appContext->getCurrentUser();
        if ($user && contains($text, '[user:first_name]')) {
            $text = str_replace('[user:first_name]', ucfirst(mb_strtolower($user->firstname)), $text);
        }

        return $text;
    }
}
