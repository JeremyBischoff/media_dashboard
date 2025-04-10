<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\MediaCard;

class MediaCardAPITest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test retrieving all media cards.
     */
    public function test_can_retrieve_all_media_cards(): void
    {
        // Create some test media cards
        MediaCard::create([
            'media_title' => 'Test Media Title 1',
            'entry_title' => 'Test Entry Title 1',
            'entry_author' => 'Test Author 1',
            'entry_url' => 'http://example.com/entry1',
        ]);

        MediaCard::create([
            'media_title' => 'Test Media Title 2',
            'entry_title' => 'Test Entry Title 2',
            'entry_author' => 'Test Author 2',
            'entry_url' => 'http://example.com/entry2',
        ]);

        // Send GET request to retrieve all media cards
        $response = $this->getJson('/api/media_cards');

        // Assert response is successful and contains the expected data
        $response->assertStatus(200)
                ->assertJsonCount(2, 'data')
                ->assertJsonStructure([
                    'data' => [
                        '*' => [
                            'id',
                            'media_title',
                            'entry_title',
                            'entry_author',
                            'entry_url'
                        ]
                    ]
                ]);
    }

    /**
     * Test retrieving a specific media card.
     */
    public function test_can_retrieve_single_media_card(): void
    {
        // Create a test media card
        $mediaCard = MediaCard::create([
            'media_title' => 'Test Media Title',
            'entry_title' => 'Test Entry Title',
            'entry_author' => 'Test Author',
            'entry_url' => 'http://example.com/entry',
        ]);

        // Send GET request to retrieve the specific media card
        $response = $this->getJson('/api/media_cards/' . $mediaCard->id);

        // Assert response is successful and contains the expected data
        $response->assertStatus(200)
                ->assertJson([
                    'data' => [
                        'id' => $mediaCard->id,
                        'media_title' => 'Test Media Title',
                        'entry_title' => 'Test Entry Title',
                        'entry_author' => 'Test Author',
                        'entry_url' => 'http://example.com/entry',
                    ]
                ]);
    }

    /**
     * Test creating a new media card.
     */
    public function test_can_create_media_card(): void
    {
        // Data for creating a new media card
        $data = [
            'media_title' => 'New Media Title',
            'entry_title' => 'New Entry Title',
            'entry_author' => 'New Author',
            'entry_url' => 'http://example.com/new-entry',
        ];

        // Send POST request to create a new media card
        $response = $this->postJson('/api/media_cards', $data);

        // Assert response is successful and contains the expected data
        $response->assertStatus(201)
                ->assertJson([
                    'data' => $data
                ]);

        // Assert the data was saved to the database
        $this->assertDatabaseHas('media_cards', $data);
    }

    /**
     * Test updating an existing media card.
     */
    public function test_can_update_media_card(): void
    {
        // Create a test media card
        $mediaCard = MediaCard::create([
            'media_title' => 'Original Media Title',
            'entry_title' => 'Original Entry Title',
            'entry_author' => 'Original Author',
            'entry_url' => 'http://example.com/original-entry',
        ]);

        // Data for updating the media card
        $data = [
            'media_title' => 'Updated Media Title',
            'entry_title' => 'Updated Entry Title',
            'entry_author' => 'Updated Author',
            'entry_url' => 'http://example.com/updated-entry',
        ];

        // Send PUT request to update the media card
        $response = $this->putJson('/api/media_cards/' . $mediaCard->id, $data);

        // Assert response is successful and contains the expected data
        $response->assertStatus(200)
                ->assertJson([
                    'data' => $data
                ]);

        // Assert the data was updated in the database
        $this->assertDatabaseHas('media_cards', $data);
        $this->assertDatabaseMissing('media_cards', [
            'media_title' => 'Original Media Title',
        ]);
    }

    /**
     * Test deleting a media card.
     */
    public function test_can_delete_media_card(): void
    {
        // Create a test media card
        $mediaCard = MediaCard::create([
            'media_title' => 'Test Media Title',
            'entry_title' => 'Test Entry Title',
            'entry_author' => 'Test Author',
            'entry_url' => 'http://example.com/entry',
        ]);

        // Send DELETE request to delete the media card
        $response = $this->deleteJson('/api/media_cards/' . $mediaCard->id);

        // Assert response is successful
        $response->assertStatus(204);

        // Assert the record was deleted from the database
        $this->assertDatabaseMissing('media_cards', [
            'id' => $mediaCard->id,
        ]);
    }

    /**
     * Test retrieving a non-existent media card.
     */
    public function test_cannot_retrieve_nonexistent_media_card(): void
    {
        // Send GET request to retrieve a non-existent media card
        $response = $this->getJson('/api/media_cards/999');

        // Assert response is not found
        $response->assertStatus(404);
    }
} 
