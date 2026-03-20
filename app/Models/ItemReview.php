<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ItemReview extends Model
{
  /**
   * Un avis appartient à un utilisateur
   * Get the user associated with this model.
   * @return BelongsTo
   */
  public function user(): BelongsTo
  {
    return $this->belongsTo(User::class, 'user_id', 'id');
  }

  /**
   * Un avis appartient à un produit
   * Define a relationship where this model belongs to an Item model.   *
   * @return BelongsTo
   */
  public function item(): BelongsTo
  {
    return $this->belongsTo(Item::class, 'item_id', 'id');
  }
}
