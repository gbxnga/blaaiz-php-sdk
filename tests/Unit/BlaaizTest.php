<?php

use Blaaiz\PhpSdk\Blaaiz;
use Blaaiz\PhpSdk\BlaaizClient;
use Blaaiz\PhpSdk\Services\CustomerService;
use Blaaiz\PhpSdk\Services\CollectionService;
use Blaaiz\PhpSdk\Services\PayoutService;
use Blaaiz\PhpSdk\Services\WalletService;
use Blaaiz\PhpSdk\Services\VirtualBankAccountService;
use Blaaiz\PhpSdk\Services\TransactionService;
use Blaaiz\PhpSdk\Services\BankService;
use Blaaiz\PhpSdk\Services\CurrencyService;
use Blaaiz\PhpSdk\Services\FeesService;
use Blaaiz\PhpSdk\Services\FileService;
use Blaaiz\PhpSdk\Services\WebhookService;

describe('Blaaiz SDK main class', function () {
    it('creates instance with API key', function () {
        $blaaiz = new Blaaiz(['api_key' => 'test-api-key']);

        expect($blaaiz)->toBeInstanceOf(Blaaiz::class);

        // Check that client is created
        $reflection = new ReflectionClass($blaaiz);
        $clientProperty = $reflection->getProperty('client');
        $clientProperty->setAccessible(true);
        $client = $clientProperty->getValue($blaaiz);

        expect($client)->toBeInstanceOf(BlaaizClient::class);
    });

    it('creates instance with custom options', function () {
        $options = [
            'base_url' => 'https://api.custom.com',
            'timeout' => 60
        ];

        $blaaiz = new Blaaiz(array_merge(['api_key' => 'test-key'], $options));

        expect($blaaiz)->toBeInstanceOf(Blaaiz::class);
    });

    it('initializes all service properties', function () {
        $blaaiz = new Blaaiz(['api_key' => 'test-key']);

        expect($blaaiz->customers)->toBeInstanceOf(CustomerService::class);
        expect($blaaiz->collections)->toBeInstanceOf(CollectionService::class);
        expect($blaaiz->payouts)->toBeInstanceOf(PayoutService::class);
        expect($blaaiz->wallets)->toBeInstanceOf(WalletService::class);
        expect($blaaiz->virtualBankAccounts)->toBeInstanceOf(VirtualBankAccountService::class);
        expect($blaaiz->transactions)->toBeInstanceOf(TransactionService::class);
        expect($blaaiz->banks)->toBeInstanceOf(BankService::class);
        expect($blaaiz->currencies)->toBeInstanceOf(CurrencyService::class);
        expect($blaaiz->fees)->toBeInstanceOf(FeesService::class);
        expect($blaaiz->files)->toBeInstanceOf(FileService::class);
        expect($blaaiz->webhooks)->toBeInstanceOf(WebhookService::class);
        expect($blaaiz->rates)->toBeInstanceOf(\Blaaiz\PhpSdk\Services\RateService::class);
        expect($blaaiz->swaps)->toBeInstanceOf(\Blaaiz\PhpSdk\Services\SwapService::class);
    });

    it('passes the same client instance to all services', function () {
        $blaaiz = new Blaaiz(['api_key' => 'test-key']);

        // Get the client from the main SDK
        $reflection = new ReflectionClass($blaaiz);
        $clientProperty = $reflection->getProperty('client');
        $clientProperty->setAccessible(true);
        $mainClient = $clientProperty->getValue($blaaiz);

        // Check that each service has the same client instance
        $services = [
            $blaaiz->customers,
            $blaaiz->collections,
            $blaaiz->payouts,
            $blaaiz->wallets,
            $blaaiz->virtualBankAccounts,
            $blaaiz->transactions,
            $blaaiz->banks,
            $blaaiz->currencies,
            $blaaiz->fees,
            $blaaiz->files,
            $blaaiz->webhooks,
            $blaaiz->rates,
            $blaaiz->swaps
        ];

        foreach ($services as $service) {
            $serviceReflection = new ReflectionClass($service);
            $serviceClientProperty = $serviceReflection->getProperty('client');
            $serviceClientProperty->setAccessible(true);
            $serviceClient = $serviceClientProperty->getValue($service);

            expect($serviceClient)->toBe($mainClient);
        }
    });

    it('has public service properties', function () {
        $blaaiz = new Blaaiz(['api_key' => 'test-key']);

        $reflection = new ReflectionClass($blaaiz);

        $serviceProperties = [
            'customers', 'collections', 'payouts', 'wallets', 'virtualBankAccounts',
            'transactions', 'banks', 'currencies', 'fees', 'files', 'webhooks', 'rates', 'swaps'
        ];

        foreach ($serviceProperties as $propertyName) {
            $property = $reflection->getProperty($propertyName);
            expect($property->isPublic())->toBeTrue();
        }
    });

    it('has protected client property', function () {
        $blaaiz = new Blaaiz(['api_key' => 'test-key']);

        $reflection = new ReflectionClass($blaaiz);
        $clientProperty = $reflection->getProperty('client');

        expect($clientProperty->isProtected())->toBeTrue();
    });
});