<?php

namespace Shippii\Resources;

class Parcel extends Resource
{
    public string|null $id;
    public string|null $sendableReference;
    public array $label = [];
}
