<?php

namespace Microsoft\Kiota\Http\Middleware\Options;

use Microsoft\Kiota\Abstractions\RequestOption;
use OpenTelemetry\API\Common\Instrumentation\Globals;
use OpenTelemetry\API\Trace\TracerInterface;

class ObservabilityOption implements RequestOption
{
    private bool $includeEUIIAttributes = true;

    private static TracerInterface $tracer;

    /**
     */
    public function __construct()
    {
        self::$tracer = Globals::tracerProvider()->getTracer(self::getTracerInstrumentationName());
    }

    /**
     * @return string
     */
    public static function getTracerInstrumentationName(): string
    {
        return "microsoft.kiota.http:kiota-http-guzzle-php";
    }

    /**
     * @param bool $includeEUIIAttributes
     */
    public function setIncludeEUIIAttributes(bool $includeEUIIAttributes): void
    {
        $this->includeEUIIAttributes = $includeEUIIAttributes;
    }

    public function getIncludeEUIIAttributes(): bool
    {
        return $this->includeEUIIAttributes;
    }

    public function setTracer(TracerInterface $tracer): void
    {
        self::$tracer = $tracer;
    }

    /**
     * @return TracerInterface
     */
    public static function getTracer(): TracerInterface
    {
        return self::$tracer;
    }
}