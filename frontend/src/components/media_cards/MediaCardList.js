import React, { useState, useEffect } from 'react';
import api from '../../services/api';
import MediaCardItem from './MediaCardItem';
import MediaCardForm from './MediaCardForm';

const MediaCardList = () => {

    const [mediaCards, setMediaCards] = useState([]);
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState(null);

    // Runs once on initial render
    useEffect(() => {
        fetchMediaCards();
    }, []);

    // GET 
    const fetchMediaCards = async () => {
        try {
            setLoading(true);
            const response = await api.get('/media_cards');
            setMediaCards(response.data.data || []);
            setError(null);
        } catch (err) {
            setError('Error fetching media cards: ' + (err.message || 'Unknown error'));
        } finally {
            setLoading(false);
        }
    };
    
    // POST
    const addMediaCard = async (newMediaCard) => {
        try {
            setLoading(true);
            const response = await api.post('/media_cards', newMediaCard);
            setMediaCards([...mediaCards, response.data.data]);
            setError(null);
        } catch (err) {
            setError('Error adding media card: ' + (err.message || 'Unknown error'));
        } finally {
            setLoading(false);
        }
    };

    // PUT
    const updateMediaCard = async (id, updatedMediaCard) => {
        try {
            setLoading(true);
            const response = await api.put(`/media_cards/${id}`, updatedMediaCard);
            setMediaCards(mediaCards.map(card => card.id === id ? response.data.data : card));
            setError(null);
        } catch (err) {
            setError('Error updating media card: ' + (err.message || 'Unknown error'));
        } finally {
            setLoading(false);
        }
    };

    // DELETE
    const deleteMediaCard = async (id) => {
        try {
            setLoading(true);
            await api.delete(`/media_cards/${id}`);
            setMediaCards(mediaCards.filter(card => card.id !== id));
            setError(null);
        } catch (err) {
            setError('Error deleting media card: ' + (err.message || 'Unknown error'));
        } finally {
            setLoading(false);
        }
    };

    // Loading and error handling
    if (loading) return <div>Loading media cards...</div>;
    if (error) return <div className="error">{error}</div>;

    return (
        <div className="media-card-list">
            <h1>Media Card List</h1>
            <MediaCardForm onAddMediaCard={addMediaCard} />
            {mediaCards.length === 0 ? (
                <p>No media cards yet. Add one above!</p>
            ) : (
                <div className="media-cards">
                    {mediaCards.map(mediaCard => (
                        <MediaCardItem 
                            key={mediaCard.id} 
                            mediaCard={mediaCard} 
                            onDelete={deleteMediaCard}
                        />
                    ))}
                </div>
            )}
        </div>
    );
}

export default MediaCardList;