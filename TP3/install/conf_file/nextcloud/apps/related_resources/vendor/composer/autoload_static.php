<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitRelatedResources
{
    public static $prefixLengthsPsr4 = array (
        'O' => 
        array (
            'OCA\\RelatedResources\\' => 21,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'OCA\\RelatedResources\\' => 
        array (
            0 => __DIR__ . '/../..' . '/lib',
        ),
    );

    public static $classMap = array (
        'OCA\\RelatedResources\\AppInfo\\Application' => __DIR__ . '/../..' . '/lib/AppInfo/Application.php',
        'OCA\\RelatedResources\\Command\\Test' => __DIR__ . '/../..' . '/lib/Command/Test.php',
        'OCA\\RelatedResources\\Controller\\ApiController' => __DIR__ . '/../..' . '/lib/Controller/ApiController.php',
        'OCA\\RelatedResources\\Db\\CalendarShareRequest' => __DIR__ . '/../..' . '/lib/Db/CalendarShareRequest.php',
        'OCA\\RelatedResources\\Db\\CalendarShareRequestBuilder' => __DIR__ . '/../..' . '/lib/Db/CalendarShareRequestBuilder.php',
        'OCA\\RelatedResources\\Db\\CoreQueryBuilder' => __DIR__ . '/../..' . '/lib/Db/CoreQueryBuilder.php',
        'OCA\\RelatedResources\\Db\\CoreRequestBuilder' => __DIR__ . '/../..' . '/lib/Db/CoreRequestBuilder.php',
        'OCA\\RelatedResources\\Db\\DeckShareRequest' => __DIR__ . '/../..' . '/lib/Db/DeckShareRequest.php',
        'OCA\\RelatedResources\\Db\\DeckShareRequestBuilder' => __DIR__ . '/../..' . '/lib/Db/DeckShareRequestBuilder.php',
        'OCA\\RelatedResources\\Db\\FilesShareRequest' => __DIR__ . '/../..' . '/lib/Db/FilesShareRequest.php',
        'OCA\\RelatedResources\\Db\\FilesShareRequestBuilder' => __DIR__ . '/../..' . '/lib/Db/FilesShareRequestBuilder.php',
        'OCA\\RelatedResources\\Db\\TalkRoomRequest' => __DIR__ . '/../..' . '/lib/Db/TalkRoomRequest.php',
        'OCA\\RelatedResources\\Db\\TalkRoomRequestBuilder' => __DIR__ . '/../..' . '/lib/Db/TalkRoomRequestBuilder.php',
        'OCA\\RelatedResources\\Exceptions\\CacheNotFoundException' => __DIR__ . '/../..' . '/lib/Exceptions/CacheNotFoundException.php',
        'OCA\\RelatedResources\\Exceptions\\DeckShareNotFoundException' => __DIR__ . '/../..' . '/lib/Exceptions/DeckShareNotFoundException.php',
        'OCA\\RelatedResources\\Exceptions\\FilesShareNotFoundException' => __DIR__ . '/../..' . '/lib/Exceptions/FilesShareNotFoundException.php',
        'OCA\\RelatedResources\\Exceptions\\RelatedResourceProviderNotFound' => __DIR__ . '/../..' . '/lib/Exceptions/RelatedResourceProviderNotFound.php',
        'OCA\\RelatedResources\\Exceptions\\TalkRoomNotFoundException' => __DIR__ . '/../..' . '/lib/Exceptions/TalkRoomNotFoundException.php',
        'OCA\\RelatedResources\\ILinkWeightCalculator' => __DIR__ . '/../..' . '/lib/ILinkWeightCalculator.php',
        'OCA\\RelatedResources\\IRelatedResource' => __DIR__ . '/../..' . '/lib/IRelatedResource.php',
        'OCA\\RelatedResources\\IRelatedResourceProvider' => __DIR__ . '/../..' . '/lib/IRelatedResourceProvider.php',
        'OCA\\RelatedResources\\LinkWeightCalculators\\AncienShareWeightCalculator' => __DIR__ . '/../..' . '/lib/LinkWeightCalculators/AncienShareWeightCalculator.php',
        'OCA\\RelatedResources\\LinkWeightCalculators\\KeywordWeightCalculator' => __DIR__ . '/../..' . '/lib/LinkWeightCalculators/KeywordWeightCalculator.php',
        'OCA\\RelatedResources\\LinkWeightCalculators\\TimeWeightCalculator' => __DIR__ . '/../..' . '/lib/LinkWeightCalculators/TimeWeightCalculator.php',
        'OCA\\RelatedResources\\Listener\\FileShareUpdate' => __DIR__ . '/../..' . '/lib/Listener/FileShareUpdate.php',
        'OCA\\RelatedResources\\Listener\\LoadSidebarScript' => __DIR__ . '/../..' . '/lib/Listener/LoadSidebarScript.php',
        'OCA\\RelatedResources\\Model\\CalendarShare' => __DIR__ . '/../..' . '/lib/Model/CalendarShare.php',
        'OCA\\RelatedResources\\Model\\DeckShare' => __DIR__ . '/../..' . '/lib/Model/DeckShare.php',
        'OCA\\RelatedResources\\Model\\FilesShare' => __DIR__ . '/../..' . '/lib/Model/FilesShare.php',
        'OCA\\RelatedResources\\Model\\RelatedResource' => __DIR__ . '/../..' . '/lib/Model/RelatedResource.php',
        'OCA\\RelatedResources\\Model\\ResourceRecipient' => __DIR__ . '/../..' . '/lib/Model/ResourceRecipient.php',
        'OCA\\RelatedResources\\Model\\TalkRoom' => __DIR__ . '/../..' . '/lib/Model/TalkRoom.php',
        'OCA\\RelatedResources\\RelatedResourceProviders\\CalendarRelatedResourceProvider' => __DIR__ . '/../..' . '/lib/RelatedResourceProviders/CalendarRelatedResourceProvider.php',
        'OCA\\RelatedResources\\RelatedResourceProviders\\DeckRelatedResourceProvider' => __DIR__ . '/../..' . '/lib/RelatedResourceProviders/DeckRelatedResourceProvider.php',
        'OCA\\RelatedResources\\RelatedResourceProviders\\FilesRelatedResourceProvider' => __DIR__ . '/../..' . '/lib/RelatedResourceProviders/FilesRelatedResourceProvider.php',
        'OCA\\RelatedResources\\RelatedResourceProviders\\TalkRelatedResourceProvider' => __DIR__ . '/../..' . '/lib/RelatedResourceProviders/TalkRelatedResourceProvider.php',
        'OCA\\RelatedResources\\Service\\ConfigService' => __DIR__ . '/../..' . '/lib/Service/ConfigService.php',
        'OCA\\RelatedResources\\Service\\MiscService' => __DIR__ . '/../..' . '/lib/Service/MiscService.php',
        'OCA\\RelatedResources\\Service\\RelatedService' => __DIR__ . '/../..' . '/lib/Service/RelatedService.php',
        'OCA\\RelatedResources\\Tools\\Db\\ExtendedQueryBuilder' => __DIR__ . '/../..' . '/lib/Tools/Db/ExtendedQueryBuilder.php',
        'OCA\\RelatedResources\\Tools\\Db\\IQueryRow' => __DIR__ . '/../..' . '/lib/Tools/Db/IQueryRow.php',
        'OCA\\RelatedResources\\Tools\\Exceptions\\ArrayNotFoundException' => __DIR__ . '/../..' . '/lib/Tools/Exceptions/ArrayNotFoundException.php',
        'OCA\\RelatedResources\\Tools\\Exceptions\\DateTimeException' => __DIR__ . '/../..' . '/lib/Tools/Exceptions/DateTimeException.php',
        'OCA\\RelatedResources\\Tools\\Exceptions\\InvalidItemException' => __DIR__ . '/../..' . '/lib/Tools/Exceptions/InvalidItemException.php',
        'OCA\\RelatedResources\\Tools\\Exceptions\\ItemNotFoundException' => __DIR__ . '/../..' . '/lib/Tools/Exceptions/ItemNotFoundException.php',
        'OCA\\RelatedResources\\Tools\\Exceptions\\MalformedArrayException' => __DIR__ . '/../..' . '/lib/Tools/Exceptions/MalformedArrayException.php',
        'OCA\\RelatedResources\\Tools\\Exceptions\\RowNotFoundException' => __DIR__ . '/../..' . '/lib/Tools/Exceptions/RowNotFoundException.php',
        'OCA\\RelatedResources\\Tools\\Exceptions\\UnknownTypeException' => __DIR__ . '/../..' . '/lib/Tools/Exceptions/UnknownTypeException.php',
        'OCA\\RelatedResources\\Tools\\IDeserializable' => __DIR__ . '/../..' . '/lib/Tools/IDeserializable.php',
        'OCA\\RelatedResources\\Tools\\Traits\\TArrayTools' => __DIR__ . '/../..' . '/lib/Tools/Traits/TArrayTools.php',
        'OCA\\RelatedResources\\Tools\\Traits\\TDeserialize' => __DIR__ . '/../..' . '/lib/Tools/Traits/TDeserialize.php',
        'OCA\\RelatedResources\\Tools\\Traits\\TStringTools' => __DIR__ . '/../..' . '/lib/Tools/Traits/TStringTools.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitRelatedResources::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitRelatedResources::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitRelatedResources::$classMap;

        }, null, ClassLoader::class);
    }
}