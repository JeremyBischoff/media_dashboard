import React from 'react';

const MediaCardItem = ({ mediaCard, onDelete }) => {
    return (
        <div className="media-card">
            <h2>{mediaCard.media_title}</h2>
            <h3>{mediaCard.entry_title}</h3>
            <p>{mediaCard.entry_author}</p>
            <a href={mediaCard.entry_url} target="_blank" rel="noopener noreferrer">Read article</a>
            <button onClick={() => onDelete(mediaCard.id)}>Delete</button>
        </div>
    );
};

export default MediaCardItem;