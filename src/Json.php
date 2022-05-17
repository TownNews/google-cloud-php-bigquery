<?php
/**
 * Copyright 2020 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace Google\Cloud\BigQuery;

/**
 * Represents a value with a data type of
 * [Json](https://cloud.google.com/bigquery/docs/reference/standard-sql/data-types#json_type).
 *
 * A value is expected to be able to be converted into a JSON payload upon being inserted or
 * converted back from JSON when being extracted from BigQuery.
 *
 * Example:
 * ```
 * use Google\Cloud\BigQuery\BigQueryClient;
 *
 * $bigQuery = new BigQueryClient();
 *
 * $json = $bigQuery->json([
 *   'example' => [
 *      'bool' => true,
 *      'int' => 1,
 *      'float' => 3.14,
 *      'enum' => [
 *         1,
 *         2,
 *         3
 *      ]
 *   ]
 * ]);
 * ```
 */
class Json implements ValueInterface
{
    /**
     * @var string
     */
    private $value;

    /**
     * @param string $value The data to be converted to JSON.
     */
    public function __construct($value)
    {
        $this->value = json_encode($value, \JSON_THROW_ON_ERROR, 500);
    }

    /**
     * Get the underlying value.
     *
     * @return string
     */
    public function get()
    {
        return json_decode($this->value, true, 500, \JSON_THROW_ON_ERROR);
    }

    /**
     * Get the type.
     *
     * @return string
     */
    public function type()
    {
        return ValueMapper::TYPE_JSON;
    }

    /**
     * Format the value as a string.
     *
     * @return string
     */
    public function formatAsString()
    {
        return $this->value;
    }

    /**
     * Format the value as a string.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->formatAsString();
    }
}
