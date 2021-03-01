<?php use App\Models\Permission;

return [
    Permission::STREAM_ALL_THE_TIME => Permission::STREAM_ALL_THE_TIME,
    Permission::FIVE_HOURS_PER_MONTH => Permission::FIVE_HOURS_PER_MONTH,
    Permission::THIRTY_HOURS_PER_MONTH => Permission::THIRTY_HOURS_PER_MONTH,
    Permission::OPEN_FOR_OBS => Permission::OPEN_FOR_OBS,
    Permission::EMBED_ON_OWN_WEBSITE => Permission::EMBED_ON_OWN_WEBSITE,
    Permission::MORE_THAN_TWO_HUNDRED_VIEWERS => Permission::MORE_THAN_TWO_HUNDRED_VIEWERS,
    Permission::TWO_HUNDRED_VIEWERS => Permission::TWO_HUNDRED_VIEWERS,
    Permission::FIFTY_VIEWERS => Permission::FIFTY_VIEWERS,
    Permission::TV_GUIDE => Permission::TV_GUIDE,
    Permission::VIEW_CONTENT => Permission::VIEW_CONTENT,
    Permission::AD_FREE => Permission::AD_FREE,
];
