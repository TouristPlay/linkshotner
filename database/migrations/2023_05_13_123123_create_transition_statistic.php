<?php

class CreateTransitionStatistic extends \PhpClickHouseLaravel\Migration
{

    protected $connection = 'clickhouse';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        static::write('
            CREATE TABLE transition_statistic (
                id UUID,
                url_id Nullable(UInt32),
                continent Nullable(String),
                continent_code Nullable(String),
                country Nullable(String),
                country_code Nullable(String),
                region Nullable(String),
                city Nullable(String),
                postal Nullable(UInt32),
                timezone Nullable(String),
                connection_provider Nullable(String),
                latitude Nullable(String),
                longitude Nullable(String),
                ip Nullable(IPv4),
                browser Nullable(String),
                os Nullable(String),
                device Nullable(String),
                deviceModel Nullable(String),
                request_time Nullable(Date),
                created_at DateTime,
            )
            ENGINE = MergeTree()
            ORDER BY (id)
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        static::write('DROP TABLE transition_statistic');
    }

}
