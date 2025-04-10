import React, { useState } from 'react';

const MediaCardForm = ({ onAddMediaCard }) => {
    // Set initial state for the form fields
    const [mediaTitle, setMediaTitle] = useState('');
    const [entryTitle, setEntryTitle] = useState('');
    const [entryAuthor, setEntryAuthor] = useState('');
    const [entryUrl, setEntryUrl] = useState('');

    const handleSubmit = (e) => {
        e.preventDefault();

        // Create new media card object
        const newMediaCard = {
            media_title: mediaTitle,
            entry_title: entryTitle,
            entry_author: entryAuthor,
            entry_url: entryUrl
        };
        onAddMediaCard(newMediaCard);

        // Reset form
        setMediaTitle('');
        setEntryTitle('');
        setEntryAuthor('');
        setEntryUrl('');
    };

    return (
        <form className="media-card-form" onSubmit={handleSubmit}>
            <div className="form-group">
                <label htmlFor="mediaTitle">Media Title</label>
                <input
                    type="text"
                    id="mediaTitle"
                    value={mediaTitle}
                    onChange={(e) => setMediaTitle(e.target.value)}
                    required
                />
            </div>
            <div className="form-group">
                <label htmlFor="entryTitle">Entry Title</label>
                <input
                    type="text"
                    id="entryTitle"
                    value={entryTitle}
                    onChange={(e) => setEntryTitle(e.target.value)}
                    required
                />
            </div>
            <div className="form-group">
                <label htmlFor="entryAuthor">Entry Author</label>
                <input
                    type="text"
                    id="entryAuthor"
                    value={entryAuthor}
                    onChange={(e) => setEntryAuthor(e.target.value)}
                    required
                />
            </div>
            <div className="form-group">
                <label htmlFor="entryUrl">Entry URL</label>
                <input
                    type="text"
                    id="entryUrl"
                    value={entryUrl}
                    onChange={(e) => setEntryUrl(e.target.value)}
                    required
                />
            </div>
            <button type="submit">Add Media Card</button>
        </form>
    );

};

export default MediaCardForm;