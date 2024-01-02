<?php 
namespace DarkSide\DsGprdCookie\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Tools;

class CookieBuildCommand extends Command
{
    protected static $defaultName = 'dsgprd:build';

    private HttpClientInterface $httpClient;
    private RequestStack $requestStack;
    private UrlGeneratorInterface $urlGenerator;

    public function __construct(HttpClientInterface $httpClient, RequestStack $requestStack, UrlGeneratorInterface $urlGenerator)
    {
        parent::__construct();

        $this->httpClient = $httpClient;
        $this->requestStack = $requestStack;
        $this->urlGenerator = $urlGenerator;
    }

    protected function configure()
    {
        $this
            ->setDescription('Builds DS: GPRD Cookie config');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $currentRequest = $this->requestStack->getCurrentRequest();
        $token = Tools::getAdminTokenLite('Admin');

        $url = $this->urlGenerator->generate(
            'ds_gprdcookie_cookie_build',
            ['_token' => $token],
            UrlGeneratorInterface::ABSOLUTE_URL
        );

        $response = $this->httpClient->request('GET', $url);
        $content = $response->getContent();

        $modulePath = _PS_MODULE_DIR_ . 'dsgprdcookie/';
        $relativePath = 'views/js/builid/builid.js';

        // Zapisujemy zawartość do pliku
        file_put_contents($modulePath . $relativePath, $content);

        // Informacja o pomyślnym wykonaniu komendy
        $output->writeln('Command executed successfully.');

        return true;
    }
}
