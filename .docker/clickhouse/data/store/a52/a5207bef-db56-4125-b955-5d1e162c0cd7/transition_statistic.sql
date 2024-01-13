ATTACH TABLE _ UUID '00c92e41-ab27-48fc-a4ed-1a7dff6b85bb'
(
    `id` UUID,
    `url_id` Nullable(UInt32),
    `continent` Nullable(String),
    `continent_code` Nullable(String),
    `country` Nullable(String),
    `country_code` Nullable(String),
    `region` Nullable(String),
    `city` Nullable(String),
    `postal` Nullable(UInt32),
    `timezone` Nullable(String),
    `connection_provider` Nullable(String),
    `latitude` Nullable(String),
    `longitude` Nullable(String),
    `ip` Nullable(IPv4),
    `browser` Nullable(String),
    `os` Nullable(String),
    `device` Nullable(String),
    `deviceModel` Nullable(String),
    `request_time` Date,
    `created_at` DateTime
)
ENGINE = MergeTree
ORDER BY id
SETTINGS index_granularity = 8192
